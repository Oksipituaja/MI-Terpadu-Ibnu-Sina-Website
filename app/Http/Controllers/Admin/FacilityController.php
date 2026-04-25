<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');

        $facilities = Facility::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%')
                        ->orWhere('kondisi', 'LIKE', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.facilities.index', compact('facilities', 'search'));
    }

    public function create(): View
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'slug'                  => 'required|string|unique:facilities',
            'description'           => 'nullable|string',
            'icon'                  => 'nullable|string',
            'featured_image_base64' => 'nullable|string',
            'kondisi'               => 'required|in:tersedia,perbaikan,belum_ada,akan_ada',
        ]);

        $newImage = $this->handleBase64Image($request->input('featured_image_base64'));
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        Facility::create($validated);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil ditambahkan!');
    }

    public function edit(Facility $facility): View
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'slug'                  => 'required|string|unique:facilities,slug,' . $facility->id,
            'description'           => 'nullable|string',
            'icon'                  => 'nullable|string',
            'featured_image_base64' => 'nullable|string',
            'kondisi'               => 'required|in:tersedia,perbaikan,belum_ada,akan_ada',
        ]);

        $newImage = $this->handleBase64Image(
            $request->input('featured_image_base64'),
            $facility->featured_image
        );
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        $facility->update($validated);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil diperbarui!');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->featured_image) {
            Storage::disk('public')->delete($facility->featured_image);
        }
        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Fasilitas berhasil dihapus!');
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

        $filename = 'facilities/crop_' . time() . '_' . Str::random(8) . '.jpg';
        Storage::disk('public')->put($filename, $decoded);

        return $filename;
    }
}
