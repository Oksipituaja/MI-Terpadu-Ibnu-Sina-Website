<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MI Terpadu Ibnu Sina') }}</title>
    <link rel="icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" type="image/png" sizes="96x96">
    <link rel="apple-touch-icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" sizes="180x180">
    <link rel="shortcut icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" type="image/x-icon">

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        /* ── Topbar ── */
        .topbar {
            background: #14532d;
            display: none;
            align-items: center;
            height: 38px;
        }

        @media(min-width:768px) {
            .topbar {
                display: flex;
            }
        }

        /* ── Dropdown ── */
        .has-dd {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .dd-menu {
            position: absolute;
            top: calc(100% + 1px);
            left: 50%;
            transform: translateX(-50%) translateY(-6px);
            min-width: 220px;
            background: #fff;
            border-radius: 14px;
            padding: 6px;
            box-shadow: 0 0 0 1px rgba(21, 128, 61, .09), 0 16px 40px -8px rgba(0, 0, 0, .14);
            opacity: 0;
            visibility: hidden;
            transition: opacity .17s, transform .17s, visibility .17s;
            z-index: 200;
        }

        .dd-menu::before {
            content: '';
            position: absolute;
            top: -5px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 10px;
            height: 10px;
            background: #fff;
            border-top: 1px solid rgba(21, 128, 61, .09);
            border-left: 1px solid rgba(21, 128, 61, .09);
        }

        .has-dd:hover .dd-menu,
        .has-dd:focus-within .dd-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .dd-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 11px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            transition: background .13s, color .13s;
        }

        .dd-item:hover {
            background: rgba(21, 128, 61, .07);
            color: #15803d;
        }

        .dd-ic {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: rgba(21, 128, 61, .07);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .dd-ic i {
            font-size: 11px;
            color: #15803d;
            opacity: .65;
        }

        .dd-item:hover .dd-ic {
            background: rgba(21, 128, 61, .14);
        }

        .dd-item:hover .dd-ic i {
            opacity: 1;
        }

        /* chevron rotate */
        .has-dd:hover .ch,
        .has-dd:focus-within .ch {
            transform: rotate(180deg);
        }

        .ch {
            transition: transform .2s;
            font-size: 9px;
            opacity: .45;
            margin-left: 2px;
        }

        /* ── Mobile drawer ── */
        #overlay {
            position: fixed;
            inset: 0;
            z-index: 400;
            background: rgba(0, 0, 0, .42);
            backdrop-filter: blur(3px);
            opacity: 0;
            pointer-events: none;
            transition: opacity .24s;
        }

        #overlay.on {
            opacity: 1;
            pointer-events: auto;
        }

        #drawer {
            position: fixed;
            top: 0;
            right: 0;
            z-index: 500;
            width: 288px;
            height: 100%;
            background: #fff;
            box-shadow: -10px 0 40px rgba(0, 0, 0, .11);
            transform: translateX(100%);
            transition: transform .28s cubic-bezier(.4, 0, .2, 1);
            overflow-y: auto;
        }

        #drawer.on {
            transform: translateX(0);
        }

        .drw-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            text-decoration: none;
            transition: background .13s, color .13s;
        }

        .drw-link:hover {
            background: rgba(21, 128, 61, .07);
            color: #15803d;
        }

        .drw-link i {
            width: 16px;
            text-align: center;
            font-size: 12px;
            color: #86efac;
            flex-shrink: 0;
        }

        .drw-link:hover i {
            color: #15803d;
        }

        .drw-sec {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .14em;
            color: #86efac;
            padding: 10px 12px 3px;
        }

        /* burger anim */
        #b1,
        #b2,
        #b3 {
            transition: transform .28s, opacity .2s;
        }
    </style>
</head>

<body class="antialiased bg-[#F0F4ED]">

    <header class="fixed top-0 left-0 right-0 z-50">

        {{-- Topbar --}}
        <div class="topbar">
            <div class="flex items-center justify-between w-full max-w-screen-xl gap-4 px-6 mx-auto">
                <div class="flex items-center flex-1 min-w-0 gap-2 overflow-hidden text-xs text-white/70">
                    <i class="fas fa-map-marker-alt text-[#86efac] flex-shrink-0 text-[10px]"></i>
                    <span class="truncate">Jl. Raya Bangsri - Keling KM.4, Dukuh Segawe, Desa Jinggotan, Kec. Kembang,
                        Kab. Jepara 59457</span>
                </div>
                <div class="flex items-center flex-shrink-0 gap-4">
                    <a href="https://api.whatsapp.com/send/?phone=%2B6282323561617&text&type=phone_number&app_absent=0"
                        class="hidden lg:flex items-center gap-1.5 text-white/70 hover:text-white text-xs transition-colors">
                        <i class="fab fa-whatsapp text-[#86efac] text-[10px]"></i>
                        <span>+62 823-2356-1617</span>
                    </a>
                    <a href="mailto:mitisjepara@gmail.com"
                        class="hidden xl:flex items-center gap-1.5 text-white/70 hover:text-white text-xs transition-colors">
                        <i class="fas fa-envelope text-[#86efac] text-[10px]"></i>
                        <span>mitisjepara@gmail.com</span>
                    </a>
                    <div class="w-px h-3.5 bg-white/15"></div>
                    <div class="flex items-center gap-3">
                        <a href="https://www.facebook.com/profile.php?id=61552982001569" target="_blank" rel="noopener"
                            class="text-white/55 hover:text-[#EAB308] text-xs transition-colors"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/mi_terpadu_ibnu_sina" target="_blank" rel="noopener"
                            class="text-white/55 hover:text-[#EAB308] text-xs transition-colors"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@mitismedia5043" target="_blank" rel="noopener"
                            class="text-white/55 hover:text-[#EAB308] text-xs transition-colors"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main nav --}}
        <nav class="h-[68px] bg-white border-b border-[#15803d]/10 shadow-sm">
            <div class="flex items-center justify-between h-full max-w-screen-xl gap-4 px-6 mx-auto">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
                    <img src="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" alt="Logo"
                        class="object-contain w-10 h-10">
                    <div class="hidden sm:block">
                        <div class="text-[14.5px] font-extrabold text-[#15803d] leading-tight tracking-tight">MI Terpadu
                            Ibnu Sina</div>
                        <div class="text-[9px] font-bold tracking-[.16em] uppercase text-[#3761b7] mt-0.5">Madrasah
                            Ibtidaiyah</div>
                    </div>
                </a>

                {{-- Desktop menu --}}
                <ul class="items-center hidden h-full gap-1 p-0 m-0 list-none lg:flex">
                    <li class="flex items-center h-full">
                        <a href="{{ route('home') }}"
                            class="flex items-center gap-1.5 px-3 py-1.5 text-[13.5px] font-semibold text-gray-600 hover:text-[#15803d] hover:bg-[#15803d]/[.07] rounded-lg transition-all">
                            <i class="fas fa-home text-[11px] opacity-55"></i> Beranda
                        </a>
                    </li>

                    <li class="h-full has-dd">
                        <span
                            class="flex items-center gap-1.5 px-3 py-1.5 text-[13.5px] font-semibold text-gray-600 hover:text-[#15803d] hover:bg-[#15803d]/[.07] rounded-lg transition-all cursor-pointer select-none">
                            <i class="fas fa-school text-[11px] opacity-55"></i> Profil <i
                                class="fas fa-chevron-down ch"></i>
                        </span>
                        <div class="dd-menu">
                            <a href="{{ route('about') }}?section=sambutan" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-user-tie"></i></span> Sambutan Kepala Sekolah</a>
                            <a href="{{ route('about') }}?section=visi-misi&expanded=1" class="dd-item"><span
                                    class="dd-ic"><i class="fas fa-bullseye"></i></span> Visi & Misi</a>
                            <a href="{{ route('about') }}?section=tentang&expanded=1" class="dd-item"><span
                                    class="dd-ic"><i class="fas fa-info-circle"></i></span> Tentang Kami</a>
                            <a href="{{ route('teachers') }}" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-chalkboard-teacher"></i></span> Tendik & Staff</a>
                        </div>
                    </li>

                    <li class="h-full has-dd">
                        <span
                            class="flex items-center gap-1.5 px-3 py-1.5 text-[13.5px] font-semibold text-gray-600 hover:text-[#15803d] hover:bg-[#15803d]/[.07] rounded-lg transition-all cursor-pointer select-none">
                            <i class="fas fa-book-open text-[11px] opacity-55"></i> Akademik <i
                                class="fas fa-chevron-down ch"></i>
                        </span>
                        <div class="dd-menu">
                            <a href="{{ route('mata-pelajaran') }}" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-book"></i></span> Mata Pelajaran</a>
                            <a href="{{ route('peraturan') }}" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-gavel"></i></span> Peraturan Sekolah</a>
                            <a href="{{ route('news') }}" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-newspaper"></i></span> Berita & Pengumuman</a>
                            <a href="{{ route('prestasi.index') }}" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-trophy"></i></span> Prestasi</a>
                            <a href="{{ route('facilities') }}" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-building"></i></span> Fasilitas</a>
                        </div>
                    </li>

                    <li class="h-full has-dd">
                        <span
                            class="flex items-center gap-1.5 px-3 py-1.5 text-[13.5px] font-semibold text-gray-600 hover:text-[#15803d] hover:bg-[#15803d]/[.07] rounded-lg transition-all cursor-pointer select-none">
                            <i class="fas fa-calendar-alt text-[11px] opacity-55"></i> Kegiatan <i
                                class="fas fa-chevron-down ch"></i>
                        </span>
                        <div class="dd-menu">
                            <a href="{{ route('news') }}?tab=agenda" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-calendar-check"></i></span> Agenda Kegiatan</a>
                            <a href="{{ route('gallery') }}" class="dd-item"><span class="dd-ic"><i
                                        class="fas fa-images"></i></span> Galeri</a>
                        </div>
                    </li>
                </ul>

                {{-- CTA + Burger --}}
                <div class="flex items-center flex-shrink-0 gap-2">
                    <div class="items-center hidden gap-2 lg:flex">
                        <a href="{{ route('ppdb') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-bold text-white rounded-xl transition-all hover:-translate-y-0.5"
                            style="background:#15803d;box-shadow:0 3px 12px rgba(21,128,61,.32)">
                            <i class="text-xs fas fa-graduation-cap"></i> SPMB
                        </a>
                        {{-- ✅ FIX: Hubungi Kami → /konsultasi (bukan #kontak footer) --}}
                        <a href="{{ route('konsultasi') }}"
                            class="inline-flex items-center gap-1.5 px-4 py-2.5 text-sm font-bold rounded-xl transition-all hover:-translate-y-0.5"
                            style="background:#EAB308;color:#14532d;box-shadow:0 3px 12px rgba(234,179,8,.28)">
                            <i class="text-xs fas fa-comments"></i>
                            <span class="hidden xl:inline">Hubungi Kami</span>
                        </a>
                    </div>

                    <a href="{{ route('ppdb') }}"
                        class="flex lg:hidden items-center gap-1.5 px-3 py-2 text-xs font-bold text-white rounded-lg"
                        style="background:#15803d">
                        <i class="fas fa-graduation-cap"></i> SPMB
                    </a>

                    <button id="burgerBtn"
                        class="flex lg:hidden flex-col justify-center gap-[5px] w-9 h-9 p-2 rounded-lg hover:bg-[#15803d]/[.07] transition-colors"
                        aria-label="Menu">
                        <span id="b1" class="block w-full h-0.5 rounded bg-[#15803d]"></span>
                        <span id="b2" class="block w-full h-0.5 rounded bg-[#15803d]"></span>
                        <span id="b3" class="block w-full h-0.5 rounded bg-[#15803d]"></span>
                    </button>
                </div>

            </div>
        </nav>
    </header>

    {{-- Overlay & Drawer --}}
    <div id="overlay"></div>
    <div id="drawer">
        <div class="flex items-center justify-between px-5 py-4 border-b border-[#15803d]/10">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 no-underline">
                <img src="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" alt="Logo"
                    class="object-contain w-8 h-8">
                <span class="text-sm font-extrabold text-[#15803d]">{{ config('app.name') }}</span>
            </a>
            <button id="drawerClose"
                class="flex items-center justify-center w-8 h-8 text-lg text-gray-500 transition-colors bg-gray-100 rounded-lg hover:bg-red-100 hover:text-red-500">×</button>
        </div>
        <div class="p-3">
            <a href="{{ route('home') }}" class="drw-link"><i class="fas fa-home"></i> Beranda</a>

            <p class="drw-sec">Profil</p>
            <a href="{{ route('about') }}?section=sambutan" class="drw-link"><i class="fas fa-user-tie"></i>
                Sambutan Kepala Sekolah</a>
            <a href="{{ route('about') }}?section=visi-misi&expanded=1" class="drw-link"><i
                    class="fas fa-bullseye"></i> Visi & Misi</a>
            <a href="{{ route('about') }}?section=tentang&expanded=1" class="drw-link"><i
                    class="fas fa-info-circle"></i> Tentang Kami</a>
            <a href="{{ route('teachers') }}" class="drw-link"><i class="fas fa-chalkboard-teacher"></i> Tenaga
                Pendidik</a>

            <p class="drw-sec">Akademik</p>
            <a href="{{ route('mata-pelajaran') }}" class="drw-link"><i class="fas fa-book"></i> Mata Pelajaran</a>
            <a href="{{ route('peraturan') }}" class="drw-link"><i class="fas fa-gavel"></i> Peraturan Sekolah</a>
            <a href="{{ route('news') }}" class="drw-link"><i class="fas fa-newspaper"></i> Berita & Pengumuman</a>
            <a href="{{ route('prestasi.index') }}" class="drw-link"><i class="fas fa-trophy"></i> Prestasi</a>
            <a href="{{ route('facilities') }}" class="drw-link"><i class="fas fa-building"></i> Fasilitas</a>

            <p class="drw-sec">Kegiatan</p>
            <a href="{{ route('news') }}?tab=agenda" class="drw-link"><i class="fas fa-calendar-check"></i> Agenda
                Kegiatan</a>
            <a href="{{ route('gallery') }}" class="drw-link"><i class="fas fa-images"></i> Galeri</a>

            <p class="drw-sec">Lainnya</p>
            {{-- ✅ Tambah link Konsultasi di drawer mobile --}}
            <a href="{{ route('konsultasi') }}" class="drw-link"><i class="fas fa-comments"></i> Konsultasi</a>

            <div class="flex flex-col gap-3 pt-4 mt-3 border-t border-[#15803d]/10">
                <a href="{{ route('ppdb') }}"
                    class="flex items-center justify-center gap-2 py-3 text-sm font-bold text-white rounded-xl"
                    style="background:#15803d">
                    <i class="fas fa-graduation-cap"></i> SPMB / PPDB
                </a>
                {{-- ✅ FIX: Hubungi Kami mobile → /konsultasi --}}
                <a href="{{ route('konsultasi') }}"
                    class="flex items-center justify-center gap-2 py-3 text-sm font-bold rounded-xl"
                    style="background:#EAB308;color:#14532d">
                    <i class="fas fa-comments"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </div>

    {{-- pt: mobile=68px, desktop=topbar(38px)+nav(68px)=106px --}}
    <main class="pt-[68px] md:pt-[106px]">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer id="kontak" class="bg-[#0c2318] text-gray-400">
        <div class="max-w-screen-xl px-6 pb-10 mx-auto pt-14">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/[.05]">

                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex items-center justify-center flex-shrink-0 w-11 h-11 rounded-xl">
                            {{-- <span class="text-xs font-black tracking-tight text-white">MI</span> 
                            style="background:linear-gradient(135deg,#15803d,#22c55e);box-shadow:0 4px 14px rgba(21,128,61,.4)"--}}
                            <img src="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" alt="Logo" class="object-contain w-10 h-10">

                        </div>
                        <div>
                            <div class="text-sm font-bold leading-tight text-white">{{ config('app.name') }}</div>
                            <div class="text-[10px] font-bold text-[#4ade80] tracking-wide">Madrasah Ibtidaiyah</div>
                        </div>
                    </div>
                    <p class="mb-5 text-sm leading-relaxed text-gray-500">Madrasah Ibtidaiyah yang berkomitmen mencetak
                        generasi unggul, berakhlak mulia, dan berdaya saing melalui pendidikan Islami yang berkualitas.
                    </p>
                    <div class="flex gap-2">
                        @foreach ([['fab fa-facebook-f', 'https://www.facebook.com/profile.php?id=61552982001569'], ['fab fa-instagram', 'https://www.instagram.com/mi_terpadu_ibnu_sina'], ['fab fa-youtube', 'https://www.youtube.com/@mitismedia5043']] as [$ic, $url])
                            <a href="{{ $url }}" target="_blank" rel="noopener"
                                class="w-9 h-9 rounded-xl flex items-center justify-center text-[#4ade80] text-xs transition-all hover:-translate-y-0.5"
                                style="background:rgba(21,128,61,.17)">
                                <i class="{{ $ic }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Halaman --}}
                <div>
                    <h4 class="text-[10px] font-extrabold uppercase tracking-[.14em] text-[#4ade80]/50 mb-5">Halaman
                    </h4>
                    <ul class="space-y-2.5 list-none p-0">
                        @foreach ([['home', 'Beranda'], ['about', 'Tentang Kami'], ['teachers', 'Tenaga Pendidik'], ['mata-pelajaran', 'Mata Pelajaran'], ['peraturan', 'Peraturan Sekolah'], ['prestasi.index', 'Prestasi'], ['facilities', 'Fasilitas'], ['gallery', 'Galeri'], ['konsultasi', 'Konsultasi']] as [$r, $l])
                            <li>
                                <a href="{{ route($r) }}"
                                    class="flex items-center gap-2 text-sm text-gray-400 no-underline transition-colors hover:text-white">
                                    <i class="fas fa-chevron-right text-[9px] text-[#15803d]/50"></i>
                                    {{ $l }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <h4 class="text-[10px] font-extrabold uppercase tracking-[.14em] text-[#4ade80]/50 mb-5">Kontak
                    </h4>
                    <div class="space-y-3.5 mb-4">
                        @foreach ([['fab fa-whatsapp', 'Telepon', 'https://api.whatsapp.com/send/?phone=%2B6282323561617&text&type=phone_number&app_absent=0', '+62 823-2356-1617'], ['fas fa-envelope', 'Email', 'mailto:mitisjepara@gmail.com', 'mitisjepara@gmail.com']] as [$ic, $lbl, $href, $val])
                            <div class="flex items-start gap-2.5">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
                                    style="background:rgba(21,128,61,.17)">
                                    <i class="{{ $ic }} text-[10px] text-[#4ade80]"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 mb-0.5">{{ $lbl }}</p>
                                    <a href="{{ $href }}"
                                        class="text-sm font-semibold text-gray-300 no-underline transition-colors hover:text-white">{!! $val !!}</a>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex items-start gap-2.5">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
                                style="background:rgba(21,128,61,.17)">
                                <i class="fas fa-map-marker-alt text-[10px] text-[#4ade80]"></i>
                            </div>
                            <div>
                                <p class="text-[10px] text-gray-500 mb-0.5">Alamat</p>
                                <p class="text-sm leading-relaxed text-gray-300">Jl. Raya Bangsri - Keling
                                    KM.4,<br>Desa Jinggotan, Kec. Kembang,<br>Kab. Jepara 59457</p>
                            </div>
                        </div>
                    </div>

                    {{-- ✅ Tambah shortcut ke konsultasi di footer kontak --}}
                    <a href="{{ route('konsultasi') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold transition-all hover:-translate-y-0.5"
                        style="background:rgba(21,128,61,.17);color:#4ade80">
                        <i class="text-xs fas fa-comments"></i> Kirim Pertanyaan
                    </a>

                    <div class="mt-4 overflow-hidden h-28 rounded-xl" style="outline:1px solid rgba(21,128,61,.18)">
                        <iframe src="https://maps.google.com/maps?q=-6.507694,110.794806&hl=id&z=16&output=embed"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            class="w-full h-full border-0"></iframe>
                    </div>
                    <a href="https://maps.app.goo.gl/D3CUGH9acTNJZzaH7" target="_blank" rel="noopener"
                        class="inline-flex items-center gap-1.5 text-xs text-[#4ade80] hover:text-[#86efac] transition-colors mt-2 no-underline">
                        <i class="fas fa-external-link-alt text-[9px]"></i> Buka di Google Maps
                    </a>
                </div>

                {{-- Jam --}}
                <div>
                    <h4 class="text-[10px] font-extrabold uppercase tracking-[.14em] text-[#4ade80]/50 mb-5">Jam
                        Operasional</h4>
                    @foreach ([['Senin – Jumat', '08:00 – 12:00', false], ['Sabtu - Minggu', 'Libur', true]] as [$d, $t, $off])
                        <div class="flex items-center justify-between py-2.5 border-b border-white/[.04]">
                            <span class="text-xs text-gray-500">{{ $d }}</span>
                            <span
                                class="text-xs font-bold px-2.5 py-1 rounded-full {{ $off ? 'bg-red-900/20 text-red-400' : 'text-[#4ade80]' }}"
                                style="{{ $off ? '' : 'background:rgba(21,128,61,.17)' }}">{{ $t }}</span>
                        </div>
                    @endforeach
                    <div class="p-4 mt-5 border rounded-xl"
                        style="background:rgba(234,179,8,.05);border-color:rgba(234,179,8,.13)">
                        <div class="flex items-center gap-2 mb-1.5">
                            <i class="fas fa-info-circle text-[10px] text-[#EAB308]"></i>
                            <span class="text-xs font-bold text-[#EAB308]">Info SPMB</span>
                        </div>
                        <p class="mb-2 text-xs leading-relaxed text-gray-500">Pendaftaran peserta didik baru dibuka
                            setiap awal tahun ajaran.</p>
                        <a href="{{ route('ppdb') }}"
                            class="text-xs font-bold text-[#EAB308] hover:text-yellow-300 inline-flex items-center gap-1 no-underline transition-colors">
                            Lihat info SPMB <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-center justify-between gap-3 md:flex-row pt-7">
                <p class="text-xs text-gray-600">© {{ date('Y') }} 
                    <span
MITIS   class="font-semibold text-gray-500">{{ config('app.name') }}</span>. Semua hak dilindungi.</p>
                <div class="flex items-center gap-1 text-xs">
                    <a href="#"
                        class="px-2.5 py-1 text-gray-500 hover:text-gray-300 rounded-lg transition-colors no-underline">Kebijakan
                        Privasi</a>
                    <span class="text-gray-700">·</span>
                    <a href="#"
                        class="px-2.5 py-1 text-gray-500 hover:text-gray-300 rounded-lg transition-colors no-underline">Syarat
                        & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        (function() {
            var btn = document.getElementById('burgerBtn'),
                ov = document.getElementById('overlay'),
                dr = document.getElementById('drawer'),
                cl = document.getElementById('drawerClose'),
                b1 = document.getElementById('b1'),
                b2 = document.getElementById('b2'),
                b3 = document.getElementById('b3');

            function init() {
                if (!btn) return;
                btn.onclick = open;
                cl.onclick = shut;
                ov.onclick = shut;
            }

            function open() {
                dr.classList.add('on');
                ov.classList.add('on');
                b1.style.transform = 'translateY(7px) rotate(45deg)';
                b2.style.opacity = '0';
                b3.style.transform = 'translateY(-7px) rotate(-45deg)';
                document.body.style.overflow = 'hidden';
            }

            function shut() {
                dr.classList.remove('on');
                ov.classList.remove('on');
                b1.style.transform = b3.style.transform = '';
                b2.style.opacity = '';
                document.body.style.overflow = '';
            }
            document.addEventListener('DOMContentLoaded', init);
            document.addEventListener('livewire:navigated', init);
        })();
    </script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
