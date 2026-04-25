<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');

        $galleries = Gallery::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('category', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.galleries.index', compact('galleries', 'search'));
    }

    public function create(): View
    {
        return view('admin.galleries.create');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'slug'                  => 'required|string|unique:galleries,slug|max:255',
            'description'           => 'nullable|string',
            'category'              => 'required|string|max:100',
            'featured_image_base64' => 'nullable|string',
        ]);

        $newImage = $this->handleBase64Image($request->input('featured_image_base64'));
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        Gallery::create($validated);
        Cache::forget('gallery.all_categories');

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'slug'                  => 'required|string|unique:galleries,slug,' . $gallery->id . '|max:255',
            'description'           => 'nullable|string',
            'category'              => 'required|string|max:100',
            'featured_image_base64' => 'nullable|string',
        ]);

        $newImage = $this->handleBase64Image(
            $request->input('featured_image_base64'),
            $gallery->featured_image
        );
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        $gallery->update($validated);
        Cache::forget('gallery.all_categories');

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->featured_image) {
            Storage::disk('public')->delete($gallery->featured_image);
        }
        $gallery->delete();
        Cache::forget('gallery.all_categories');

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Galeri berhasil dihapus.');
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

        $filename = 'gallery/crop_' . time() . '_' . Str::random(8) . '.jpg';
        Storage::disk('public')->put($filename, $decoded);

        return $filename;
    }
}
