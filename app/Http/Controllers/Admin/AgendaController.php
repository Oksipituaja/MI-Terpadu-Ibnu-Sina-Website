<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function index(): View
    {
        $agendas = Agenda::orderBy('event_date', 'desc')->paginate(15);

        return view('admin.agendas.index', compact('agendas'));
    }

    public function create(): View
    {
        return view('admin.agendas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:agendas,slug|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|string',
            'location'    => 'nullable|string|max:255',
            // 'status' tidak divalidasi — dihitung otomatis
        ]);

        $this->splitDateTime($validated);

        Agenda::create($validated);

        return redirect()->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda): View
    {
        return view('admin.agendas.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|string|unique:agendas,slug,' . $agenda->id . '|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|string',
            'location'    => 'nullable|string|max:255',
        ]);

        $this->splitDateTime($validated);

        $agenda->update($validated);

        return redirect()->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('admin.agendas.index')
            ->with('success', 'Agenda berhasil dihapus.');
    }

    /**
     * Flatpickr mengirim event_date sebagai "2026-05-02 07:00"
     * Pisah menjadi event_date (date) dan event_time (time)
     */
    private function splitDateTime(array &$validated): void
    {
        $raw = $validated['event_date'] ?? '';

        if (str_contains($raw, ' ')) {
            [$date, $time]           = explode(' ', $raw, 2);
            $validated['event_date'] = $date;
            $validated['event_time'] = $time . ':00'; // "07:00" → "07:00:00"
        } else {
            $validated['event_date'] = $raw;
            $validated['event_time'] = null;
        }
    }
}
