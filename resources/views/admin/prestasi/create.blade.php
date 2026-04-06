@extends('admin.layout')

@section('page_title', 'Tambah Prestasi')
@section('page_subtitle', 'Tambah prestasi peserta didik baru')

@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.prestasis.store') }}" method="POST" class="space-y-5">
            @csrf

            <input type="hidden" name="slug" id="prestasiSlug" value="{{ old('slug') }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Judul Prestasi</label>
                <input type="text" name="title" id="prestasiTitle" value="{{ old('title') }}" required
                    placeholder="cth: Juara 1 Olimpiade Matematika Tingkat Kabupaten"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Kategori
                    <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>
                <input type="text" name="category" value="{{ old('category') }}" list="categoryOptions"
                    placeholder="Pilih atau ketik kategori..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <datalist id="categoryOptions">
                    <option value="Juara 1">
                    <option value="Juara 2">
                    <option value="Juara 3">
                    <option value="Harapan 1">
                    <option value="Harapan 2">
                    <option value="Harapan 3">
                    <option value="Finalis">
                    <option value="Peserta">
                </datalist>
                @error('category')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Prestasi</label>
                <div class="flex gap-2">
                    <div id="achievementDateDisplay"
                        class="flex-1 px-4 py-2 text-sm text-gray-400 border border-gray-300 rounded-lg select-none bg-gray-50">
                        Belum dipilih
                    </div>
                    <input type="hidden" name="achievement_date" id="achievement_date_input"
                        value="{{ old('achievement_date') }}">
                    <button type="button" id="btn-pick-date"
                        class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shrink-0">
                        <i class="mr-1 fas fa-calendar"></i> Pilih
                    </button>
                </div>
                @error('achievement_date')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <x-image-crop-upload name="featured_image" label="Gambar Prestasi" aspect-ratio="16/9" :optional="true"
                :error="$errors->first('featured_image_base64')" />

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft (Belum Tayang)
                    </option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publikasi (Tayang)
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Prestasi',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.prestasis.index') }}"
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

            // ── AUTO SLUG ──────────────────────────────────────────────────────
            const titleInput = document.getElementById('prestasiTitle');
            const slugInput = document.getElementById('prestasiSlug');

            function generateSlug(text) {
                return text.toLowerCase().trim()
                    .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
                    .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o')
                    .replace(/[ùúûü]/g, 'u')
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/[\s-]+/g, '-').replace(/^-+|-+$/g, '');
            }

            titleInput.addEventListener('input', function() {
                slugInput.value = generateSlug(this.value);
            });

            // ── TINYMCE ────────────────────────────────────────────────────────
            tinymce.init({
                selector: '#description',
                license_key: 'gpl',
                height: 300,
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
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });

            // ── DATE PICKER ────────────────────────────────────────────────────
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const display = document.getElementById('achievementDateDisplay');
            const hiddenInput = document.getElementById('achievement_date_input');
            const btnPickDate = document.getElementById('btn-pick-date');

            const fpContainer = document.createElement('div');
            fpContainer.style.cssText = 'position:fixed;z-index:99999;display:none;';
            document.body.appendChild(fpContainer);

            const fp = flatpickr(fpContainer, {
                enableTime: false,
                dateFormat: 'Y-m-d',
                disableMobile: true,
                locale: window.flatpickrLocaleId,
                defaultDate: hiddenInput.value || null,
                onChange: function(selectedDates) {
                    if (selectedDates[0]) {
                        const d = selectedDates[0];
                        hiddenInput.value = d.getFullYear() + '-' +
                            String(d.getMonth() + 1).padStart(2, '0') + '-' +
                            String(d.getDate()).padStart(2, '0');
                        display.textContent = String(d.getDate()).padStart(2, '0') + ' ' +
                            months[d.getMonth()] + ' ' + d.getFullYear();
                        display.classList.remove('text-gray-400');
                        display.classList.add('text-gray-800');
                    }
                },
                onClose: function() {
                    fpContainer.style.display = 'none';
                }
            });

            btnPickDate.addEventListener('click', function(e) {
                e.stopPropagation();
                const rect = btnPickDate.getBoundingClientRect();
                fpContainer.style.cssText =
                    `position:fixed;z-index:99999;top:${rect.bottom + 8}px;left:${rect.left}px;display:block;`;
                fp.open();
            });

            document.addEventListener('click', function(e) {
                const cal = document.querySelector('.flatpickr-calendar');
                if (!fpContainer.contains(e.target) && !(cal && cal.contains(e.target)) && e.target.id !==
                    'btn-pick-date') {
                    fp.close();
                    fpContainer.style.display = 'none';
                }
            });
        });
    </script>
@endpush
