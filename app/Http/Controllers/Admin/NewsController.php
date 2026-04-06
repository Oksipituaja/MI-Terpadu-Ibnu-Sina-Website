<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::with('user')->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'slug'                  => 'required|string|unique:news',
            'content'               => 'required|string',
            'excerpt'               => 'nullable|string',
            'featured_image_base64' => 'nullable|string',
            'status'                => 'required|in:draft,published',
            'published_at'          => 'nullable|date',
        ]);

        $newImage = $this->handleBase64Image($request->input('featured_image_base64'));
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        $validated['user_id'] = auth()->id();

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'                 => 'required|string|max:255',
            'slug'                  => 'required|string|unique:news,slug,' . $news->id,
            'content'               => 'required|string',
            'excerpt'               => 'nullable|string',
            'featured_image_base64' => 'nullable|string',
            'status'                => 'required|in:draft,published',
            'published_at'          => 'nullable|date',
        ]);

        $newImage = $this->handleBase64Image(
            $request->input('featured_image_base64'),
            $news->featured_image
        );
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus!');
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

        $filename = 'news/crop_' . time() . '_' . Str::random(8) . '.jpg';
        Storage::disk('public')->put($filename, $decoded);

        return $filename;
    }
}
