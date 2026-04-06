<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $abouts = About::paginate(15);
        return view('admin.about.index', compact('abouts'));
    }

    public function create(): View
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'principal_name'         => 'nullable|string|max:255',
            'key'                    => 'required|string|unique:abouts',
            'content'                => 'nullable|string',
            'featured_image_base64'  => 'nullable|string',
        ]);

        // Simpan gambar dari base64 jika ada
        $newImage = $this->handleBase64Image($request->input('featured_image_base64'), $validated['key']);
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        // Bersihkan field base64 agar tidak masuk ke DB
        unset($validated['featured_image_base64']);

        if (empty($validated['content'])) {
            $validated['content'] = '';
        }

        About::create($validated);
        $this->clearAboutCache();

        return redirect()->route('admin.about.index')
            ->with('success', 'Konten berhasil ditambahkan!');
    }


    public function edit(About $about): View
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(About $about, Request $request)
    {
        \Log::info('UPDATE_DEBUG', [
            'keys'      => array_keys($request->all()),
            'has_b64'   => $request->has('featured_image_base64'),
            'b64_len'   => strlen($request->input('featured_image_base64', '')),
            'b64_start' => substr($request->input('featured_image_base64', ''), 0, 50),
        ]);

        $validated = $request->validate([
            'title'                  => 'required|string|max:255',
            'principal_name'         => 'nullable|string|max:255',
            'key'                    => 'required|string|unique:abouts,key,' . $about->id,
            'content'                => 'nullable|string',
            'featured_image_base64'  => 'nullable|string',
        ]);

        // Simpan gambar baru dari base64 jika ada, hapus yang lama
        $newImage = $this->handleBase64Image(
            $request->input('featured_image_base64'),
            $validated['key'],
            $about->featured_image
        );
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        // Bersihkan field base64 agar tidak masuk ke DB
        unset($validated['featured_image_base64']);

        if (empty($validated['content'])) {
            $validated['content'] = $about->content ?? '';
        }

        $about->update($validated);
        $this->clearAboutCache();

        return redirect()->route('admin.about.index')
            ->with('success', 'Konten berhasil diperbarui!');
    }

    public function destroy(About $about)
    {
        if ($about->featured_image) {
            Storage::disk('public')->delete($about->featured_image);
        }
        $about->delete();
        $this->clearAboutCache();

        return redirect()->route('admin.about.index')
            ->with('success', 'Konten berhasil dihapus!');
    }

    /**
     * Decode base64 image string dan simpan ke storage.
     * Mengembalikan path file yang disimpan, atau null jika tidak ada input.
     */
    private function handleBase64Image(?string $base64, string $key, ?string $oldImage = null): ?string
    {
        if (empty($base64)) {
            return null;
        }

        // Validasi format data URL
        if (!preg_match('/^data:image\/(jpeg|jpg|png|webp|gif);base64,/i', $base64)) {
            return null;
        }

        // Ambil data setelah koma
        $imageData = substr($base64, strpos($base64, ',') + 1);
        $decoded   = base64_decode($imageData, true);

        if ($decoded === false || strlen($decoded) < 100) {
            return null;
        }

        // Hapus file lama jika ada
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        // Tentukan folder berdasarkan key
        $folder = match ($key) {
            'home_hero_image' => 'hero/home',
            'hero_image'      => 'hero/about',
            default           => 'about',
        };

        $filename = $folder . '/crop_' . time() . '_' . Str::random(8) . '.jpg';
        Storage::disk('public')->put($filename, $decoded);

        return $filename;
    }

    private function clearAboutCache(): void
    {
        Cache::forget('about.principal_greeting');
        Cache::forget('about.home_hero_image');
        Cache::forget('about.hero_image');
    }
}
