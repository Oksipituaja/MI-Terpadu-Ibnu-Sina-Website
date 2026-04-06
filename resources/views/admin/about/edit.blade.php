@extends('admin.layout')
@section('page_title', 'Edit Konten Sekolah')
@section('page_subtitle', 'Perbarui informasi tentang sekolah')
@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form id="aboutForm" action="{{ route('admin.about.update', $about) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" value="{{ old('title', $about->title) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="principalNameField" class="{{ $about->key !== 'principal_greeting' ? 'hidden' : '' }}">
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Kepala Sekolah</label>
                <input type="text" name="principal_name" value="{{ old('principal_name', $about->principal_name) }}"
                    placeholder="cth: Drs. Ahmad Fauzi, M.Pd"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Tipe Konten</label>
                <select id="keySelect" name="key" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 bg-gray-50">
                    <option value="home_hero_image" {{ $about->key === 'home_hero_image' ? 'selected' : '' }}>Gambar Hero
                        Beranda</option>
                    <option value="hero_image" {{ $about->key === 'hero_image' ? 'selected' : '' }}>Gambar Hero Tentang Kami
                    </option>
                    <option value="principal_greeting" {{ $about->key === 'principal_greeting' ? 'selected' : '' }}>Sambutan
                        Kepala Sekolah</option>
                    <option value="school_profile" {{ $about->key === 'school_profile' ? 'selected' : '' }}>Profil Sekolah
                    </option>
                    <option value="school_info" {{ $about->key === 'school_info' ? 'selected' : '' }}>Informasi Sekolah
                        (JSON)</option>
                    <option value="vision" {{ $about->key === 'vision' ? 'selected' : '' }}>Visi</option>
                    <option value="mission" {{ $about->key === 'mission' ? 'selected' : '' }}>Misi</option>
                </select>
                <p id="keyHint" class="hidden mt-1 text-xs text-gray-400"></p>
            </div>

            @php
                $info = [];
                if ($about->key === 'school_info') {
                    $info = json_decode($about->content, true) ?: [];
                }
                $imageOnlyKeys = ['home_hero_image', 'hero_image'];
                $noImageKeys = ['school_profile', 'vision', 'mission', 'school_info'];
            @endphp

            {{-- JSON Fields --}}
            <div id="schoolInfoFields"
                class="{{ $about->key !== 'school_info' ? 'hidden' : '' }} p-4 space-y-4 border border-blue-200 rounded-lg bg-blue-50">
                <p class="text-xs font-semibold text-blue-700">Data Informasi Sekolah</p>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">NPSN</label>
                        <input type="text" id="si_npsn" value="{{ $info['npsn'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">NSM</label>
                        <input type="text" id="si_nsm" value="{{ $info['nsm'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Nama Sekolah</label>
                        <input type="text" id="si_nama_sekolah" value="{{ $info['nama_sekolah'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Naungan</label>
                        <input type="text" id="si_naungan" value="{{ $info['naungan'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Tanggal Berdiri</label>
                        <input type="text" id="si_tanggal_berdiri" value="{{ $info['tanggal_berdiri'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">No. SK Pendirian</label>
                        <input type="text" id="si_no_sk_pendirian" value="{{ $info['no_sk_pendirian'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Tanggal Operasional</label>
                        <input type="text" id="si_tanggal_operasional" value="{{ $info['tanggal_operasional'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">No. SK Operasional</label>
                        <input type="text" id="si_no_sk_operasional" value="{{ $info['no_sk_operasional'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Jenjang Pendidikan</label>
                        <input type="text" id="si_jenjang_pendidikan" value="{{ $info['jenjang_pendidikan'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Status Sekolah</label>
                        <input type="text" id="si_status_sekolah" value="{{ $info['status_sekolah'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Akreditasi</label>
                        <input type="text" id="si_akreditasi" value="{{ $info['akreditasi'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Tanggal Akreditasi</label>
                        <input type="text" id="si_tanggal_akreditasi" value="{{ $info['tanggal_akreditasi'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-1 text-xs font-medium text-gray-700">No. SK Akreditasi</label>
                        <input type="text" id="si_no_sk_akreditasi" value="{{ $info['no_sk_akreditasi'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Alamat</label>
                        <input type="text" id="si_alamat" value="{{ $info['alamat'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Desa</label>
                        <input type="text" id="si_desa" value="{{ $info['desa'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Kecamatan</label>
                        <input type="text" id="si_kecamatan" value="{{ $info['kecamatan'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Kabupaten</label>
                        <input type="text" id="si_kabupaten" value="{{ $info['kabupaten'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-medium text-gray-700">Provinsi</label>
                        <input type="text" id="si_provinsi" value="{{ $info['provinsi'] ?? '' }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg si-input">
                    </div>
                </div>
            </div>

            {{-- Content TinyMCE --}}
            <div id="contentWrapper"
                class="{{ $about->key === 'school_info' || in_array($about->key, $imageOnlyKeys) ? 'hidden' : '' }}">
                <label class="block mb-1 text-sm font-medium text-gray-700">Konten</label>
                <div id="tinymce-skeleton" class="w-full overflow-hidden bg-gray-100 border border-gray-200 rounded-lg"
                    style="height:350px;">
                    <div class="flex items-center gap-2 px-3 py-2 border-b border-gray-200 bg-gray-50">
                        @for ($i = 0; $i < 10; $i++)
                            <div class="h-5 bg-gray-200 rounded animate-pulse"
                                style="width:{{ [28, 28, 32, 28, 32, 28, 28, 36, 28, 32][$i] }}px"></div>
                            @if (in_array($i, [1, 3, 6]))
                                <div class="w-px h-5 mx-1 bg-gray-300"></div>
                            @endif
                        @endfor
                    </div>
                    <div class="p-4 space-y-3">
                        @foreach ([75, 100, 83, 66, 100, 80] as $w)
                            <div class="h-4 bg-gray-200 rounded animate-pulse" style="width:{{ $w }}%"></div>
                        @endforeach
                    </div>
                </div>
                <textarea name="content" id="contentField" class="hidden">{{ old('content', $about->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Crop Components --}}
            <div id="imageFieldWrapper" class="{{ in_array($about->key, $noImageKeys) ? 'hidden' : '' }}">
                <div id="crop169" class="{{ $about->key === 'principal_greeting' ? 'hidden' : '' }}">
                    <x-image-crop-upload name="featured_image" label="Gambar" aspect-ratio="16/9" :optional="true"
                        :current-image="$about->featured_image && $about->key !== 'principal_greeting' ? url('/files/' . $about->featured_image) : null" :current-alt="$about->title" :error="$errors->first('featured_image_base64')" />
                </div>
                <div id="crop11" class="{{ $about->key !== 'principal_greeting' ? 'hidden' : '' }}">
                    <x-image-crop-upload name="featured_image" label="Foto Kepala Sekolah" aspect-ratio="1/1"
                        preview-class="w-40 h-40" :optional="true" :current-image="$about->featured_image && $about->key === 'principal_greeting' ? url('/files/' . $about->featured_image) : null" :current-alt="$about->title"
                        :error="$errors->first('featured_image_base64')" />
                </div>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Perubahan',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.about.index') }}"
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
            const keySelect = document.getElementById('keySelect');
            const contentField = document.getElementById('contentField');
            const contentWrapper = document.getElementById('contentWrapper');
            const skeleton = document.getElementById('tinymce-skeleton');
            const keyHint = document.getElementById('keyHint');
            const imageWrapper = document.getElementById('imageFieldWrapper');
            const crop169 = document.getElementById('crop169');
            const crop11 = document.getElementById('crop11');

            const imageOnlyKeys = ['home_hero_image', 'hero_image'];
            const noImageKeys = ['school_profile', 'vision', 'mission', 'school_info'];
            const hints = {
                'home_hero_image': 'Gambar ini ditampilkan di section kanan hero halaman Beranda.',
                'hero_image': 'Gambar ini ditampilkan sebagai banner besar di halaman Tentang Kami.',
                'principal_greeting': 'Foto & sambutan kepala sekolah ditampilkan di Beranda dan halaman Tentang.',
            };

            const siFields = {
                npsn: 'si_npsn',
                nsm: 'si_nsm',
                nama_sekolah: 'si_nama_sekolah',
                naungan: 'si_naungan',
                tanggal_berdiri: 'si_tanggal_berdiri',
                no_sk_pendirian: 'si_no_sk_pendirian',
                tanggal_operasional: 'si_tanggal_operasional',
                no_sk_operasional: 'si_no_sk_operasional',
                jenjang_pendidikan: 'si_jenjang_pendidikan',
                status_sekolah: 'si_status_sekolah',
                akreditasi: 'si_akreditasi',
                tanggal_akreditasi: 'si_tanggal_akreditasi',
                no_sk_akreditasi: 'si_no_sk_akreditasi',
                alamat: 'si_alamat',
                desa: 'si_desa',
                kecamatan: 'si_kecamatan',
                kabupaten: 'si_kabupaten',
                provinsi: 'si_provinsi',
            };

            let tinymceReady = false;

            function buildJson() {
                const data = {};
                Object.entries(siFields).forEach(([key, id]) => {
                    const el = document.getElementById(id);
                    if (el) data[key] = el.value;
                });
                contentField.value = JSON.stringify(data);
            }

            document.querySelectorAll('.si-input').forEach(el => el.addEventListener('input', buildJson));

            function initTinyMCE() {
                if (tinymceReady || typeof tinymce === 'undefined') return;
                tinymceReady = true;
                tinymce.init({
                    selector: '#contentField',
                    license_key: 'gpl',
                    height: 350,
                    menubar: false,
                    plugins: 'lists link autolink',
                    toolbar: ['undo redo | bold italic underline strikethrough | forecolor backcolor',
                        'bullist numlist | outdent indent | blockquote | link | alignleft aligncenter alignright | removeformat'
                    ],
                    toolbar_mode: 'wrap',
                    skin_url: '/build/tinymce/skins/ui/oxide',
                    content_css: '/build/tinymce/skins/content/default/content.min.css',
                    content_style: 'body { font-family: sans-serif; font-size: 14px; line-height: 1.8; }',
                    setup: e => e.on('change', () => e.save()),
                    init_instance_callback: () => {
                        const s = document.getElementById('tinymce-skeleton');
                        if (s) s.remove();
                        contentField.classList.remove('hidden');
                    }
                });
            }

            function toggleFields() {
                const key = keySelect.value;
                const isImageOnly = imageOnlyKeys.includes(key);
                const isSchoolInfo = key === 'school_info';
                const hasContent = key !== '' && !isSchoolInfo && !isImageOnly;
                const showImage = !noImageKeys.includes(key) && key !== '';
                const isPrincipal = key === 'principal_greeting';

                keyHint.textContent = hints[key] ?? '';
                keyHint.classList.toggle('hidden', !hints[key]);
                document.getElementById('principalNameField').classList.toggle('hidden', !isPrincipal);
                document.getElementById('schoolInfoFields').classList.toggle('hidden', !isSchoolInfo);
                contentWrapper.classList.toggle('hidden', !hasContent);
                imageWrapper.classList.toggle('hidden', !showImage);
                if (showImage) {
                    crop169.classList.toggle('hidden', isPrincipal);
                    crop11.classList.toggle('hidden', !isPrincipal);
                }

                if (isSchoolInfo) {
                    if (typeof tinymce !== 'undefined' && tinymce.get('contentField')) {
                        tinymce.get('contentField').remove();
                        tinymceReady = false;
                    }
                    if (skeleton) skeleton.style.display = 'none';
                    contentField.classList.remove('hidden');
                    buildJson();
                } else if (hasContent) {
                    if (skeleton) skeleton.style.display = '';
                    contentField.classList.add('hidden');
                    initTinyMCE();
                } else {
                    if (typeof tinymce !== 'undefined' && tinymce.get('contentField')) {
                        tinymce.get('contentField').remove();
                        tinymceReady = false;
                    }
                    if (skeleton) skeleton.style.display = 'none';
                }
            }

            keySelect.addEventListener('change', toggleFields);
            toggleFields();

            // FIX: Disable input base64 yang ada di div hidden saat submit
            // Supaya browser hanya mengirim satu input featured_image_base64 yang aktif
            document.getElementById('aboutForm').addEventListener('submit', function() {
                [crop169, crop11].forEach(function(div) {
                    if (div.classList.contains('hidden')) {
                        div.querySelectorAll('input[name="featured_image_base64"]').forEach(
                            function(input) {
                                input.disabled = true;
                            });
                    }
                });
            });
        });
    </script>
@endpush
