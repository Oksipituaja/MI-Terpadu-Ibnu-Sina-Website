@extends('admin.layout')
@section('page_title', 'Edit Foto Galeri')
@section('page_subtitle', 'Perbarui informasi foto galeri')
@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <input type="hidden" name="slug" value="{{ old('slug', $gallery->slug) }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Judul Foto</label>
                <input type="text" name="title" value="{{ old('title', $gallery->title) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $gallery->category) }}" required
                    list="categoryList"
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
                <div id="tinymce-skeleton" class="w-full overflow-hidden bg-gray-100 border border-gray-200 rounded-lg"
                    style="height:250px;">
                    <div class="flex items-center gap-2 px-3 py-2 border-b border-gray-200 bg-gray-50">
                        @for ($i = 0; $i < 8; $i++)
                            <div class="h-5 bg-gray-200 rounded animate-pulse"
                                style="width:{{ [28, 28, 32, 28, 28, 36, 28, 32][$i] }}px"></div>
                            @if (in_array($i, [1, 4]))
                                <div class="w-px h-5 mx-1 bg-gray-300"></div>
                            @endif
                        @endfor
                    </div>
                    <div class="p-4 space-y-3">
                        @foreach ([75, 100, 66, 83] as $w)
                            <div class="h-4 bg-gray-200 rounded animate-pulse" style="width:{{ $w }}%"></div>
                        @endforeach
                    </div>
                </div>
                <textarea name="description" id="description" class="hidden">{{ old('description', $gallery->description) }}</textarea>
            </div>

            <x-image-crop-upload name="featured_image" label="Foto" aspect-ratio="4/3" :optional="true" :max-size-mb="5"
                :current-image="$gallery->featured_image ? url('/files/' . $gallery->featured_image) : null" :current-alt="$gallery->title" :error="$errors->first('featured_image_base64')" />

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Perubahan',
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
                init_instance_callback: () => {
                    const s = document.getElementById('tinymce-skeleton');
                    if (s) s.remove();
                    document.getElementById('description').classList.remove('hidden');
                }
            });
        });
    </script>
@endpush
