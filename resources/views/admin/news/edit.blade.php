@extends('admin.layout')
@section('page_title', 'Edit Berita')
@section('page_subtitle', 'Perbarui artikel berita')
@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="p-6 bg-white rounded-lg shadow">
            <form action="{{ route('admin.news.update', $news) }}" method="POST" class="space-y-6">
                @csrf @method('PUT')
                <input type="hidden" id="slug" name="slug" value="{{ old('slug', $news->slug) }}">

                <div>
                    <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Judul Berita</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="excerpt" class="block mb-1 text-sm font-medium text-gray-700">
                        Ringkasan
                        <span class="ml-1 text-xs font-normal text-gray-400">(ditampilkan di halaman daftar berita)</span>
                    </label>
                    <textarea id="excerpt" name="excerpt" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('excerpt', $news->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block mb-1 text-sm font-medium text-gray-700">Isi Berita</label>
                    <div id="tinymce-skeleton" class="w-full overflow-hidden bg-gray-100 border border-gray-200 rounded-lg"
                        style="height:450px;">
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
                    <textarea id="content" name="content" class="hidden">{{ old('content', $news->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="draft" {{ old('status', $news->status) === 'draft' ? 'selected' : '' }}>
                                Draft (Belum Tayang)
                            </option>
                            <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>
                                Publikasi (Tayang)
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Publikasi</label>
                        <div class="flex gap-2">
                            <div id="publishDateDisplay"
                                class="flex-1 px-4 py-2 text-sm border border-gray-300 rounded-lg select-none bg-gray-50 {{ $news->published_at ? 'text-gray-800' : 'text-gray-400' }}">
                                @if ($news->published_at)
                                    {{ $news->published_at->format('d M Y, H:i') }}
                                @else
                                    Belum dipilih
                                @endif
                            </div>
                            <input type="hidden" name="published_at" id="published_at_input"
                                value="{{ old('published_at', $news->published_at?->format('Y-m-d H:i')) }}">
                            <button type="button" id="btn-pick-date"
                                class="px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 shrink-0">
                                <i class="mr-1 fas fa-calendar"></i> Pilih
                            </button>
                        </div>
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <x-image-crop-upload name="featured_image" label="Gambar Utama" aspect-ratio="16/9" :optional="true"
                    :max-size-mb="5" :current-image="$news->featured_image ? url('/files/' . $news->featured_image) : null" :current-alt="$news->title" :error="$errors->first('featured_image_base64')" />

                <div class="flex gap-3 pt-4 border-t">
                    @include('components.admin-submit-btn', [
                        'label' => 'Simpan Perubahan',
                        'loading' => 'Menyimpan...',
                    ])
                    <a href="{{ route('admin.news.index') }}"
                        class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                        <i class="mr-2 fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── TINYMCE
            tinymce.init({
                selector: '#content',
                license_key: 'gpl',
                height: 450,
                menubar: false,
                plugins: 'lists link autolink',
                toolbar: [
                    'undo redo | bold italic underline strikethrough | forecolor backcolor',
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
                    document.getElementById('content').classList.remove('hidden');
                }
            });

            // ── DATE PICKER
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const display = document.getElementById('publishDateDisplay');
            const hiddenInput = document.getElementById('published_at_input');
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
                onChange(selectedDates) {
                    if (!selectedDates[0]) return;
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
                        String(d.getMinutes()).padStart(2, '0');
                    display.classList.replace('text-gray-400', 'text-gray-800');
                },
                onClose() {
                    fpContainer.style.display = 'none';
                }
            });

            btnPickDate.addEventListener('click', e => {
                e.stopPropagation();
                const r = btnPickDate.getBoundingClientRect();
                fpContainer.style.cssText =
                    `position:fixed;z-index:99999;top:${r.bottom + 8}px;left:${r.left}px;display:block;`;
                fp.open();
            });

            document.addEventListener('click', e => {
                const cal = document.querySelector('.flatpickr-calendar');
                if (!fpContainer.contains(e.target) && !(cal?.contains(e.target)) && e.target.id !==
                    'btn-pick-date') {
                    fp.close();
                    fpContainer.style.display = 'none';
                }
            });
        });
    </script>
@endpush
