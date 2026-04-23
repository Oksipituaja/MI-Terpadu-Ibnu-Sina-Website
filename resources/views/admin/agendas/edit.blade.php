@extends('admin.layout')

@section('page_title', 'Edit Kegiatan')
@section('page_subtitle', 'Perbarui informasi agenda kegiatan')

@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.agendas.update', $agenda) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <input type="hidden" name="slug" value="{{ old('slug', $agenda->slug) }}">

            {{-- Judul --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Judul Kegiatan</label>
                <input type="text" name="title" id="agendaTitle" value="{{ old('title', $agenda->title) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal & Waktu --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal & Waktu Kegiatan</label>
                <div class="flex gap-2">
                    <div id="eventDateDisplay"
                        class="flex-1 px-4 py-2 text-sm border border-gray-300 rounded-lg select-none bg-gray-50
                        {{ old('event_date', $agenda->event_date_time) ? 'text-gray-800' : 'text-gray-400' }}">
                        @if (old('event_date', $agenda->event_date_time))
                            {{ \Carbon\Carbon::parse(old('event_date', $agenda->event_date_time))->translatedFormat('d M Y, H:i') }}
                            WIB
                        @else
                            Belum dipilih
                        @endif
                    </div>
                    <input type="hidden" name="event_date" id="event_date_input"
                        value="{{ old('event_date', $agenda->event_date_time) }}">
                    <button type="button" id="btn-pick-date"
                        class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shrink-0">
                        <i class="mr-1 fas fa-calendar"></i> Pilih
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-400">
                    <i class="fas fa-info-circle"></i>
                    Status ditentukan otomatis: <strong>Berlangsung</strong> (hari ini) /
                    <strong>Mendatang</strong> (akan datang) / <strong>Selesai</strong> (sudah lewat).
                </p>
                @error('event_date')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Lokasi <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>
                <input type="text" name="location" value="{{ old('location', $agenda->location) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    Deskripsi <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>

                {{-- Skeleton loading TinyMCE --}}
                <div id="tinymce-skeleton" class="w-full overflow-hidden bg-gray-100 border border-gray-200 rounded-lg"
                    style="height:300px;">
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
                        <div class="w-3/4 h-4 bg-gray-200 rounded animate-pulse"></div>
                        <div class="w-full h-4 bg-gray-200 rounded animate-pulse"></div>
                        <div class="w-2/3 h-4 bg-gray-200 rounded animate-pulse"></div>
                        <div class="w-5/6 h-4 bg-gray-200 rounded animate-pulse"></div>
                        <div class="w-1/2 h-4 bg-gray-200 rounded animate-pulse"></div>
                    </div>
                </div>

                <textarea name="description" id="description" class="hidden">{{ old('description', $agenda->description) }}</textarea>
            </div>

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Perubahan',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.agendas.index') }}"
                    class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                // ── DATE PICKER ────────────────────────────────────────────────────
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                const display = document.getElementById('eventDateDisplay');
                const hiddenInput = document.getElementById('event_date_input');
                const btnPickDate = document.getElementById('btn-pick-date');

                const fpContainer = document.createElement('div');
                fpContainer.style.cssText = 'position:fixed;z-index:99999;display:none;';
                document.body.appendChild(fpContainer);

                const fp = flatpickr(fpContainer, {
                    enableTime: true,
                    dateFormat: 'Y-m-d H:i',
                    time_24hr: true,
                    disableMobile: true,
                    locale: window.flatpickrLocaleId,
                    defaultDate: hiddenInput.value || null,
                    onChange: function(selectedDates) {
                        if (selectedDates[0]) {
                            const d = selectedDates[0];
                            hiddenInput.value =
                                d.getFullYear() + '-' +
                                String(d.getMonth() + 1).padStart(2, '0') + '-' +
                                String(d.getDate()).padStart(2, '0') + ' ' +
                                String(d.getHours()).padStart(2, '0') + ':' +
                                String(d.getMinutes()).padStart(2, '0');

                            display.textContent =
                                String(d.getDate()).padStart(2, '0') + ' ' +
                                months[d.getMonth()] + ' ' + d.getFullYear() + ', ' +
                                String(d.getHours()).padStart(2, '0') + ':' +
                                String(d.getMinutes()).padStart(2, '0') + ' WIB';

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
                    if (
                        !fpContainer.contains(e.target) &&
                        !(cal && cal.contains(e.target)) &&
                        e.target.id !== 'btn-pick-date'
                    ) {
                        fp.close();
                        fpContainer.style.display = 'none';
                    }
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
                    ignore_clickoutside_selector: '[class*="flatpickr"]',
                    setup: function(editor) {
                        editor.on('change', function() {
                            editor.save();
                        });
                    },
                    init_instance_callback: function() {
                        const sk = document.getElementById('tinymce-skeleton');
                        if (sk) sk.remove();
                    }
                });
            });
        </script>
    @endpush
@endsection
