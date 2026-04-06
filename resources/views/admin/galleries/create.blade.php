{{-- galleries/create.blade.php --}}
@extends('admin.layout')
@section('page_title', 'Tambah Foto Galeri')
@section('page_subtitle', 'Tambah foto baru ke galeri sekolah')
@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.galleries.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="slug" id="gallerySlug" value="{{ old('slug') }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Judul Foto</label>
                <input type="text" name="title" id="galleryTitle" value="{{ old('title') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" name="category" value="{{ old('category') }}" required list="categoryList"
                    placeholder="cth: Acara Sekolah, Olahraga, Seni"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <datalist id="categoryList">
                    <option value="Acara Sekolah">
                    <option value="Program Pembelajaran">
                    <option value="Olahraga">
                    <option value="Seni">
                    <option value="Ekstrakurikuler">
                    <option value="Keagamaan">
                </datalist>
                @error('category')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Deskripsi <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <x-image-crop-upload name="featured_image" label="Foto" aspect-ratio="4/3" :optional="true" :max-size-mb="5"
                :error="$errors->first('featured_image_base64')" />

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Foto',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.galleries.index') }}"
                    class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('galleryTitle');
            const slugInput = document.getElementById('gallerySlug');

            function generateSlug(t) {
                return t.toLowerCase().trim()
                    .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
                    .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o').replace(/[ùúûü]/g, 'u')
                    .replace(/[^a-z0-9\s-]/g, '').replace(/[\s-]+/g, '-').replace(/^-+|-+$/g, '');
            }
            titleInput.addEventListener('input', function() {
                slugInput.value = generateSlug(this.value);
            });

            tinymce.init({
                selector: '#description',
                license_key: 'gpl',
                height: 250,
                menubar: false,
                plugins: 'lists link autolink',
                toolbar: [
                    'undo redo | bold italic underline | forecolor',
                    'bullist numlist | link | removeformat'
                ],
                toolbar_mode: 'wrap',
                skin_url: '/build/tinymce/skins/ui/oxide',
                content_css: '/build/tinymce/skins/content/default/content.min.css',
                content_style: 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; }',
                setup: e => e.on('change', () => e.save()),
            });
        });
    </script>
@endpush
