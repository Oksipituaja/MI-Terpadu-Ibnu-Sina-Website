<div class="min-h-screen" style="background: #F0F4ED">

<style>
        .tinymce-render p {
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .tinymce-render strong {
            font-weight: 700;
        }

        .tinymce-render em {
            font-style: italic;
        }

        .tinymce-render u {
            text-decoration: underline;
        }

        .tinymce-render s {
            text-decoration: line-through;
        }

        .tinymce-render ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin: 0.75rem 0 !important;
        }

        .tinymce-render ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin: 0.75rem 0 !important;
        }

        .tinymce-render li {
            margin-bottom: 0.5rem;
            line-height: 1.7;
        }

        .tinymce-render blockquote {
            border-left: 4px solid #15803d !important;
            padding: 12px 16px !important;
            margin: 16px 0 !important;
            background: #f0fdf4 !important;
            color: #166534 !important;
            font-style: italic;
            border-radius: 0 8px 8px 0;
            display: block !important;
        }

        .tinymce-render a {
            color: #15803d;
            text-decoration: underline;
        }

        .tinymce-render h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render h4 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render [style*="text-align: center"] {
            text-align: center !important;
        }

        .tinymce-render [style*="text-align: right"] {
            text-align: right !important;
        }

        .tinymce-render [style*="text-align: justify"] {
            text-align: justify !important;
        }
</style>

    @php
        $heroImagePath = $heroImage?->featured_image ? url('/files/' . $heroImage->featured_image) : null;
    @endphp

    @if ($heroImagePath)
        <div class="relative overflow-hidden h-96" style="background: linear-gradient(to bottom right, #15803d, #14532d)">
            <img src="{{ $heroImagePath }}" alt="{{ $heroImage->title ?? config('app.name') }}"
                class="object-cover w-full h-full">
            <div class="absolute inset-0" style="background: linear-gradient(to top, #14532d, transparent, transparent)">
            </div>
        </div>
    @else
        <div class="flex items-center justify-center h-96"
            style="background: linear-gradient(to bottom right, #15803d, #14532d)">
            <div class="text-center text-white">
                <i class="mb-4 text-6xl fas fa-school opacity-40"></i>
                <p class="text-xl font-medium opacity-60">Profil Sekolah</p>
            </div>
        </div>
    @endif

    <div class="max-w-6xl px-4 py-10 mx-auto">
        <h1 class="mb-6 text-4xl font-bold" style="color: #14532d">Tentang Kami</h1>

        {{-- Section Profil Sekolah --}}
        <section id="school-profile" class="scroll-mt-40 py-12 border-t border-b border-[#15803d]/10">
            <div class="mb-10">
                <h2 class="text-[1.9rem] md:text-[2.2rem] font-bold text-[#14532d] tracking-tight">
                    {{ $schoolProfile?->title ?? 'Profil Sekolah' }}
                </h2>
            </div>

            @if ($schoolProfile)
                @if ($schoolProfile->featured_image)
                    <div class="mb-8 overflow-hidden rounded-2xl" style="box-shadow:0 8px 32px rgba(0,0,0,.08)">
                        <img src="{{ url('/files/' . $schoolProfile->featured_image) }}"
                            class="object-cover w-full max-h-72" alt="{{ $schoolProfile->title }}">
                    </div>
                @endif

                @php
                    $info   = is_string($schoolProfile->content)
                                ? (json_decode($schoolProfile->content, true) ?: [])
                                : [];
                    $isJson = !empty($info) && is_array($info);
                @endphp

                @if ($isJson)
                    {{-- Konten berbentuk JSON → tampil sebagai grid card --}}
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($info as $key => $val)
                            <div class="flex items-start gap-3 p-4 bg-white rounded-2xl border border-[#15803d]/10"
                                style="box-shadow:0 2px 12px rgba(21,128,61,.06)">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5"
                                    style="background:rgba(21,128,61,.10)">
                                    <i class="fas fa-check-circle text-[#15803d] text-sm"></i>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-bold tracking-widest uppercase mb-1"
                                        style="color:#9ca3af">
                                        {{ str_replace('_', ' ', $key) }}
                                    </span>
                                    <p class="text-[14px] font-bold text-[#14532d]">{{ $val }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Konten HTML dari TinyMCE → render langsung --}}
                    <div class="tinymce-render bg-white p-8 rounded-2xl border border-[#15803d]/10"
                        style="box-shadow:0 2px 12px rgba(21,128,61,.06)">
                        {!! $schoolProfile->content !!}
                    </div>
                @endif

            @else
                {{-- Fallback jika belum ada data school_profile di DB --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ([
                        ['Nama Madrasah',    'MI Terpadu Ibnu Sina',                          'fas fa-school'],
                        ['NPSN',             '-',                                              'fas fa-id-card'],
                        ['Status',           'Swasta',                                         'fas fa-building'],
                        ['Akreditasi',       'B',                                              'fas fa-certificate'],
                        ['Tahun Berdiri',    '-',                                              'fas fa-calendar'],
                        ['Kepala Madrasah',  '-',                                              'fas fa-user-tie'],
                        ['Alamat',           'Desa Jinggotan, Kec. Kembang, Kab. Jepara',     'fas fa-map-marker-alt'],
                        ['Telepon',          '(022) 5947-1234',                               'fas fa-phone'],
                        ['Email',            'info@miterpaduibnusina.sch.id',                 'fas fa-envelope'],
                    ] as [$label, $val, $icon])
                        <div class="flex items-start gap-3 p-4 bg-white rounded-2xl border border-[#15803d]/10"
                            style="box-shadow:0 2px 12px rgba(21,128,61,.06)">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 mt-0.5"
                                style="background:rgba(21,128,61,.10)">
                                <i class="{{ $icon }} text-[#15803d] text-sm"></i>
                            </div>
                            <div>
                                <span class="block text-[10px] font-extrabold tracking-widest uppercase mb-1"
                                    style="color:#9ca3af">{{ $label }}</span>
                                <p class="text-[14px] font-bold text-[#14532d]">{{ $val }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="mt-5 text-xs italic text-gray-400">
                    * Data profil sekolah belum diisi. Tambahkan melalui menu Admin → About dengan key
                    <code>school_profile</code>.
                </p>
            @endif
        </section>

        {{-- Section Sambutan --}}
        @if ($principalGreeting)
        <div id="sambutan" class="relative py-16 my-12 overflow-hidden rounded-xl scroll-mt-32"
            style="background: linear-gradient(to bottom right, #F0F4ED, #dcfce7, #F0F4ED)">

            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-0 left-0 rounded-full w-96 h-96 blur-3xl" style="background: #15803d"></div>
                <div class="absolute bottom-0 right-0 rounded-full w-96 h-96 blur-3xl" style="background: #EAB308"></div>
            </div>

            <div class="relative z-10 px-8">

                {{-- Header --}}
                <div class="mb-10 text-center">
                    <span class="text-sm font-semibold tracking-widest uppercase" style="color: #15803d">Sambutan</span>
                    <h2 class="mt-1 text-3xl font-bold md:text-4xl" style="color: #14532d">
                        {{ $principalGreeting->title ?? 'Sambutan Kepala Sekolah' }}
                    </h2>
                </div>

                {{-- Card --}}
                <div class="max-w-4xl mx-auto overflow-hidden bg-white rounded-2xl"
                     style="border: 1px solid rgba(21,128,61,0.12); box-shadow: 0 8px 32px rgba(21,128,61,0.08)">
                    <div class="flex flex-col md:flex-row">

                        {{-- Kolom Foto --}}
                        <div class="flex flex-col items-center justify-end flex-shrink-0 px-8 pt-8 md:w-56"
                             style="background: linear-gradient(to bottom, #f0fdf4, #dcfce7)">
                            <div class="flex items-center justify-center overflow-hidden border-4 border-white rounded-full w-44 h-44"
                                 style="background: #d1fae5; box-shadow: 0 4px 20px rgba(21,128,61,0.15)">
                                @if ($principalGreeting->featured_image)
                                    <img src="{{ url('/files/' . $principalGreeting->featured_image) }}"
                                         alt="Kepala Sekolah"
                                         class="object-cover w-full h-full">
                                @else
                                    <i class="text-5xl fas fa-user-tie" style="color: #15803d"></i>
                                @endif
                            </div>
                            <div class="mt-4 mb-6 px-5 py-1.5 rounded-full text-white text-sm font-bold text-center whitespace-nowrap"
                                 style="background: #15803d">
                                {{ $principalGreeting->principal_name ?? 'Kepala Madrasah' }}
                            </div>
                        </div>

                        {{-- Kolom Teks --}}
                        <div class="flex-1 p-8">
                            <div class="relative">
                                <div id="sambutan-text"
                                     class="overflow-hidden text-sm leading-relaxed text-gray-700"
                                     style="max-height: 200px; transition: max-height 0.4s ease">
                                    <div class="tinymce-render">{!! $principalGreeting->content !!}</div>
                                </div>
                                <div id="sambutan-fade"
                                     class="absolute bottom-0 left-0 right-0 h-16 pointer-events-none"
                                     style="background: linear-gradient(transparent, white)">
                                </div>
                            </div>

                            <button id="sambutan-toggle"
                                    onclick="toggleSambutan()"
                                    class="mt-3 text-xs font-bold flex items-center gap-1 rounded-md px-3 py-1.5"
                                    style="color: #15803d; border: 1.5px solid rgba(21,128,61,0.35); background: none; cursor: pointer">
                                <span id="sambutan-lbl">Baca Selengkapnya</span>
                                <span id="sambutan-chv" style="display: inline-block; transition: transform 0.3s">▾</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            var sambutanOpen = false;
            function toggleSambutan() {
                sambutanOpen = !sambutanOpen;
                var el   = document.getElementById('sambutan-text');
                var fade = document.getElementById('sambutan-fade');
                var lbl  = document.getElementById('sambutan-lbl');
                var chv  = document.getElementById('sambutan-chv');
                if (sambutanOpen) {
                    el.style.maxHeight  = el.scrollHeight + 'px';
                    fade.style.display  = 'none';
                    lbl.textContent     = 'Sembunyikan';
                    chv.style.transform = 'rotate(180deg)';
                } else {
                    el.style.maxHeight  = '200px';
                    fade.style.display  = 'block';
                    lbl.textContent     = 'Baca Selengkapnya';
                    chv.style.transform = 'rotate(0deg)';
                }
            }
        </script>
        @endif

        {{-- Tombol Pelajari Lebih Lanjut --}}
        @if (!$principalGreeting)
            <div class="my-12 text-center">
                <button wire:click="expand"
                    class="inline-flex items-center px-8 py-4 font-bold text-white transition-all rounded-lg shadow-lg hover:-translate-y-0.5"
                    style="background: #15803d; box-shadow: 0 4px 16px #15803d33;">
                    <i class="mr-3 fas fa-book"></i>
                    Pelajari Lebih Lanjut
                    <i class="ml-2 fas fa-chevron-down"></i>
                </button>
            </div>
        @endif

        {{-- Visi Misi --}}
        @if ($vision || $mission)
            <div id="visi-misi" class="grid gap-8 pt-12 my-16 border-t md:grid-cols-2 scroll-mt-32"
                style="border-color: #15803d26">
                @if ($vision)
                    <div class="p-8 shadow-sm rounded-2xl" style="background: white; border-left: 8px solid #15803d">
                        <h3 class="mb-4 text-2xl font-bold" style="color: #14532d">{{ $vision->title }}</h3>
                        <div class="leading-relaxed text-gray-700 tinymce-render">{!! $vision->content !!}</div>
                    </div>
                @endif

                @if ($mission)
                    <div class="p-8 shadow-sm rounded-2xl" style="background: white; border-left: 8px solid #EAB308">
                        <h3 class="mb-4 text-2xl font-bold" style="color: #854d0e">{{ $mission->title }}</h3>
                        <div class="leading-relaxed text-gray-700 tinymce-render">{!! $mission->content !!}</div>
                    </div>
                @endif
            </div>
        @endif

        {{-- Looping Sections Lainnya --}}
        @forelse($aboutSections as $section)
            <div class="pt-12 mb-16 border-t scroll-mt-32" style="border-color: #15803d26">
                <h2 class="mb-8 text-3xl font-bold" style="color: #14532d">{{ $section->title }}</h2>

                @if ($section->featured_image)
                    <div class="mb-8 overflow-hidden shadow-lg rounded-2xl">
                        <img src="{{ url('/files/' . $section->featured_image) }}" class="object-cover w-full max-h-96"
                            alt="{{ $section->title }}">
                    </div>
                @endif

                @if ($section->key === 'school_info')
                    @php $info = json_decode($section->content, true) ?: []; @endphp
                    <div class="grid grid-cols-2 gap-6 p-6 bg-white shadow-sm rounded-2xl">
                        @foreach ($info as $key => $val)
                            <div>
                                <span class="block mb-1 text-xs font-bold tracking-widest text-gray-400 uppercase">
                                    {{ str_replace('_', ' ', $key) }}
                                </span>
                                <p class="text-base font-semibold text-gray-800">{{ $val }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="leading-relaxed text-gray-700 tinymce-render">
                        {!! $section->content !!}
                    </div>
                @endif
            </div>
        @empty
        @endforelse

    </div>

    {{-- Smooth Scroll & Active Tab JS --}}
    <script>
        (function() {
            var NAV_H = window.innerWidth >= 768 ? 106 + 56 : 68 + 56;

            var target = '{{ $activeSection }}' || window.location.hash.replace('#', '');
            if (target) {
                var el = document.getElementById(target);
                if (el) {
                    setTimeout(function() {
                        var top = el.getBoundingClientRect().top + window.scrollY - NAV_H - 12;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }, 180);
                }
            }

            var tabs = document.querySelectorAll('.section-tab');
            var sections = Array.from(tabs).map(function(t) {
                return document.getElementById(t.dataset.section);
            });

            function setActive(id) {
                tabs.forEach(function(t) {
                    var isActive = t.dataset.section === id;
                    t.style.color      = isActive ? '#15803d' : '#6b7280';
                    t.style.background = isActive ? 'rgba(21,128,61,.10)' : '';
                    t.style.fontWeight = isActive ? '700' : '600';
                });
            }

            function onScroll() {
                var scrollY = window.scrollY + NAV_H + 24;
                var active  = null;
                sections.forEach(function(s) {
                    if (!s) return;
                    if (s.offsetTop <= scrollY) active = s.id;
                });
                if (active) setActive(active);
            }

            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();

            tabs.forEach(function(tab) {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    var el = document.getElementById(tab.dataset.section);
                    if (!el) return;
                    var top = el.getBoundingClientRect().top + window.scrollY - NAV_H - 8;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                    history.pushState(null, '', '#' + tab.dataset.section);
                });
            });
        })();
    </script>
</div>
</div>