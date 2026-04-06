@extends('admin.layout')
@section('page_title', 'Tambah Fasilitas')
@section('page_subtitle', 'Tambah data fasilitas sekolah baru')
@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.facilities.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="slug" id="facilitySlug" value="{{ old('slug') }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Fasilitas</label>
                <input type="text" name="name" id="facilityName" value="{{ old('name') }}" required
                    placeholder="cth: Perpustakaan, Laboratorium IPA"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Ikon <span class="ml-1 text-xs text-gray-400">(Font Awesome, cth: fas fa-book)</span>
                </label>
                <div class="flex items-center gap-2">
                    <input type="text" name="icon" id="iconInput" value="{{ old('icon') }}"
                        placeholder="fas fa-book" oninput="updateIconPreview()"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg shrink-0">
                        <i id="iconPreviewEl" class="{{ old('icon') ?? 'fas fa-question' }} text-blue-600 text-lg"></i>
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Cari ikon di <a href="https://fontawesome.com/icons" target="_blank"
                        class="text-blue-600 hover:underline">fontawesome.com/icons</a>
                </p>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Deskripsi <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Kondisi Fasilitas</label>
                <select name="kondisi"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="tersedia" {{ old('kondisi') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="perbaikan" {{ old('kondisi') === 'perbaikan' ? 'selected' : '' }}>Sedang Perbaikan
                    </option>
                    <option value="belum_ada" {{ old('kondisi') === 'belum_ada' ? 'selected' : '' }}>Belum Ada</option>
                    <option value="akan_ada" {{ old('kondisi') === 'akan_ada' ? 'selected' : '' }}>Akan Ada</option>
                </select>
                @error('kondisi')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-image-crop-upload name="featured_image" label="Gambar Fasilitas" aspect-ratio="16/9" :optional="true"
                :max-size-mb="5" :error="$errors->first('featured_image_base64')" />

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Fasilitas',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.facilities.index') }}"
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
            const nameInput = document.getElementById('facilityName');
            const slugInput = document.getElementById('facilitySlug');

            function generateSlug(t) {
                return t.toLowerCase().trim()
                    .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
                    .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o').replace(/[ùúûü]/g, 'u')
                    .replace(/[^a-z0-9\s-]/g, '').replace(/[\s-]+/g, '-').replace(/^-+|-+$/g, '');
            }
            nameInput.addEventListener('input', function() {
                slugInput.value = generateSlug(this.value);
            });

            window.updateIconPreview = function() {
                const val = document.getElementById('iconInput').value.trim();
                document.getElementById('iconPreviewEl').className = (val || 'fas fa-question') +
                    ' text-blue-600 text-lg';
            };

            tinymce.init({
                selector: '#description',
                license_key: 'gpl',
                height: 300,
                menubar: false,
                plugins: 'lists link autolink',
                toolbar: ['undo redo | bold italic underline | forecolor',
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
