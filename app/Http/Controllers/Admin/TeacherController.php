<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');

        $teachers = Teacher::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhere('email', 'LIKE', '%' . $search . '%')
                      ->orWhere('subject', 'LIKE', '%' . $search . '%');
                });
            })
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        return view('admin.teachers.index', compact('teachers', 'search'));
    }

    public function create(): View
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'slug'                  => 'required|string|unique:teachers',
            'email'                 => 'required|email|unique:teachers',
            'phone'                 => 'nullable|string',
            'subject'               => 'nullable|string',
            'featured_image_base64' => 'nullable|string',
        ]);

        $validated['sort_order'] = $this->resolveSortOrder($validated['subject'] ?? '');

        $newImage = $this->handleBase64Image($request->input('featured_image_base64'));
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        Teacher::create($validated);
        Cache::forget('home.featured_teachers');

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil ditambahkan!');
    }

    public function edit(Teacher $teacher): View
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Teacher $teacher, Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'slug'                  => 'required|string|unique:teachers,slug,' . $teacher->id,
            'email'                 => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone'                 => 'nullable|string',
            'subject'               => 'nullable|string',
            'featured_image_base64' => 'nullable|string',
        ]);

        $validated['sort_order'] = $this->resolveSortOrder($validated['subject'] ?? '');

        $newImage = $this->handleBase64Image(
            $request->input('featured_image_base64'),
            $teacher->featured_image
        );
        if ($newImage) {
            $validated['featured_image'] = $newImage;
        }

        unset($validated['featured_image_base64']);

        $teacher->update($validated);
        Cache::forget('home.featured_teachers');

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil diperbarui!');
    }

    public function destroy(Teacher $teacher)
    {
        if ($teacher->featured_image) {
            Storage::disk('public')->delete($teacher->featured_image);
        }

        $teacher->delete();
        Cache::forget('home.featured_teachers');

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Guru berhasil dihapus!');
    }

    private function resolveSortOrder(?string $subject): int
    {
        $subject = strtolower($subject ?? '');

        if (str_contains($subject, 'kepala sekolah')) return 0;
        if (str_contains($subject, 'wakil kepala') || str_contains($subject, 'waka')) return 1;

        return 99;
    }

    private function handleBase64Image(?string $base64, ?string $oldImage = null): ?string
    {
        if (empty($base64)) return null;

        if (!preg_match('/^data:image\/(jpeg|jpg|png|webp|gif);base64,/i', $base64)) return null;

        $imageData = substr($base64, strpos($base64, ',') + 1);
        $decoded   = base64_decode($imageData, true);

        if ($decoded === false || strlen($decoded) < 100) return null;

        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        $filename = 'teachers/crop_' . time() . '_' . Str::random(8) . '.jpg';
        Storage::disk('public')->put($filename, $decoded);

        return $filename;
    }
}