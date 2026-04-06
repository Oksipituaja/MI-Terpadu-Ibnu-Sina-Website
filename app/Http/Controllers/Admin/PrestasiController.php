<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PrestasiController extends Controller
{
    public function index(): View
    {
        $prestasis = Prestasi::orderByRaw("
            CASE 
                WHEN category LIKE '%Juara 1%' THEN 1
                WHEN category LIKE '%Juara 2%' THEN 2
                WHEN category LIKE '%Juara 3%' THEN 3
                WHEN category LIKE '%Harapan 1%' THEN 4
                WHEN category LIKE '%Harapan 2%' THEN 5
                WHEN category LIKE '%Harapan 3%' THEN 6
                WHEN category LIKE '%Harapan%' THEN 7
                ELSE 99
            END,
            achievement_date DESC
        ")->paginate(15);

        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create(): View
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'required|string',
            'category'              => 'nullable|string|max:100',
            'achievement_date'      => 'nullable|date',
            'featured_image_base64' => 'nullable|string',
            'status'                => 'required|in:draft,published',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title']);

        $newImage = $this->handleBase64Image($request->input('featured_image_base64'));
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        Prestasi::create($validated);

        return redirect()->route('admin.prestasis.index')
            ->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(Prestasi $prestasi): View
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'description'           => 'required|string',
            'category'              => 'nullable|string|max:100',
            'achievement_date'      => 'nullable|date',
            'featured_image_base64' => 'nullable|string',
            'status'                => 'required|in:draft,published',
        ]);

        $validated['slug'] = $this->generateUniqueSlug($validated['title'], $prestasi->id);

        $newImage = $this->handleBase64Image(
            $request->input('featured_image_base64'),
            $prestasi->featured_image
        );
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        $prestasi->update($validated);

        return redirect()->route('admin.prestasis.index')
            ->with('success', 'Prestasi berhasil diperbarui!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->featured_image) {
            Storage::disk('public')->delete($prestasi->featured_image);
        }
        $prestasi->delete();

        return redirect()->route('admin.prestasis.index')
            ->with('success', 'Prestasi berhasil dihapus!');
    }

    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug     = Str::slug($title);
        $baseSlug = $slug;
        $counter  = 1;

        while (
            Prestasi::where('slug', $slug)
            ->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function handleBase64Image(?string $base64, ?string $oldImage = null): ?string
    {
        if (empty($base64)) {
            return null;
        }

        if (!preg_match('/^data:image\/(jpeg|jpg|png|webp|gif);base64,/i', $base64)) {
            return null;
        }

        $imageData = substr($base64, strpos($base64, ',') + 1);
        $decoded   = base64_decode($imageData, true);

        if ($decoded === false || strlen($decoded) < 100) {
            return null;
        }

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        $filename = 'prestasi/crop_' . time() . '_' . Str::random(8) . '.jpg';
        Storage::disk('public')->put($filename, $decoded);

        return $filename;
    }
}
