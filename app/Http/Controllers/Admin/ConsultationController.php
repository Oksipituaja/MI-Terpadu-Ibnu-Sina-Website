<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ConsultationReplyMail;
use App\Models\Consultation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Consultation::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $consultations = $query->paginate(15)->withQueryString();

        return view('admin.consultations.index', [
            'consultations' => $consultations,
            'totalAll'      => Consultation::count(),
            'totalPending'  => Consultation::where('status', 'pending')->count(),
            'totalReplied'  => Consultation::where('status', 'replied')->count(),
        ]);
    }

    public function reply(Request $request, Consultation $consultation): RedirectResponse
    {
        $request->validate([
            'reply' => 'required|string|min:5|max:5000',
        ], [
            'reply.required' => 'Jawaban tidak boleh kosong.',
            'reply.min'      => 'Jawaban minimal 5 karakter.',
        ]);

        // Simpan jawaban ke DB sebelum kirim email
        $consultation->update([
            'reply'      => $request->reply,
            'replied_at' => now(),
            'status'     => 'replied',
        ]);

        try {
            // Force mail config untuk PHP-FPM web process
            config([
                'mail.mailers.smtp.host'       => 'mild.jagoanhosting.id',
                'mail.mailers.smtp.port'       => 587,
                'mail.mailers.smtp.encryption' => 'tls',
                'mail.mailers.smtp.username'   => 'info@mitisjepara.com',
                'mail.mailers.smtp.password'   => 'DashboardInfo10',
                'mail.from.address'            => 'info@mitisjepara.com',
                'mail.from.name'               => 'MI Terpadu Ibnu Sina',
            ]);
            Mail::purge('smtp');

            Mail::to($consultation->email)
                ->send(new ConsultationReplyMail($consultation));

            Log::info('[ConsultationController] Email balasan berhasil dikirim', [
                'consultation_id' => $consultation->id,
                'to'              => $consultation->email,
            ]);

            return redirect()
                ->route('admin.consultations.index')
                ->with('success', "Jawaban berhasil dikirim ke {$consultation->email}.");
        } catch (\Exception $e) {
            Log::error('[ConsultationController] Gagal kirim email balasan', [
                'consultation_id' => $consultation->id,
                'to'              => $consultation->email,
                'error'           => $e->getMessage(),
            ]);

            return redirect()
                ->route('admin.consultations.index')
                ->with('warning', 'Jawaban tersimpan, tapi email gagal dikirim: ' . $e->getMessage());
        }
    }

    public function destroy(Consultation $consultation): RedirectResponse
    {
        $consultation->delete();

        return redirect()
            ->route('admin.consultations.index')
            ->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
