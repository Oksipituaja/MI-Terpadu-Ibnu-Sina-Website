<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" type="image/png" sizes="96x96">
    <link rel="apple-touch-icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" sizes="180x180">
    <link rel="shortcut icon" href="{{ asset('MI-Terpadu-Ibnu-Sina-Kembang-Jepara-Logo.png') }}" type="image/x-icon">
    <title>@yield('title', 'Admin Panel - MI Terpadu Ibnu Sina')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .flatpickr-calendar { z-index: 9999 !important; }
        [x-cloak] { display: none !important; }

        /* ── Scrollbar sidebar — tebal & jelas ── */
        #sidebar-nav::-webkit-scrollbar { width: 6px; }
        #sidebar-nav::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
            border-radius: 4px;
            margin: 4px 0;
        }
        #sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.30);
            border-radius: 4px;
        }
        #sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.55);
        }

        /* ── Fade gradient bawah ── */
        .sidebar-scroll-wrap {
            position: relative;
            flex: 1;
            min-height: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar-scroll-wrap::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 52px;
            background: linear-gradient(to bottom, transparent, rgba(17,24,39,0.97));
            pointer-events: none;
            transition: opacity 0.3s;
        }
        .sidebar-scroll-wrap.at-bottom::after { opacity: 0; }

        /* ── Bounce animasi panah ── */
        @keyframes bounceY {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(4px); }
        }
        .scroll-hint-icon { animation: bounceY 1.4s ease-in-out infinite; }

        #scroll-hint { transition: opacity 0.3s; }
    </style>
</head>
<body class="bg-gray-100">
<div class="flex h-screen overflow-hidden">

    {{-- ═══════════ SIDEBAR ═══════════ --}}
    <aside class="flex flex-col flex-shrink-0 w-64 h-screen bg-gray-900">

        {{-- Logo — tidak ikut scroll --}}
        <div class="flex-shrink-0 p-6 border-b border-gray-800">
            <h1 class="text-xl font-bold text-white">MI Terpadu Ibnu Sina</h1>
            <p class="text-xs text-gray-400">Panel Admin</p>
        </div>

        {{-- Scroll wrapper --}}
        <div class="sidebar-scroll-wrap" id="sidebar-wrap">

            {{-- Nav scrollable --}}
            <nav id="sidebar-nav" class="flex-1 p-4 space-y-1 overflow-y-auto" style="padding-bottom:3rem;">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                    <i class="w-5 mr-2 fas fa-chart-line"></i> Dashboard
                </a>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 mb-2 text-xs font-semibold tracking-wider text-gray-500 uppercase">Kelola Konten</p>

                    <a href="{{ route('admin.news.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.news.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-newspaper"></i> Berita & Artikel
                    </a>
                    <a href="{{ route('admin.teachers.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.teachers.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-chalkboard-user"></i> Data Guru
                    </a>
                    <a href="{{ route('admin.galleries.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.galleries.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-images"></i> Galeri Foto
                    </a>
                    <a href="{{ route('admin.agendas.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.agendas.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-calendar"></i> Agenda Kegiatan
                    </a>
                    <a href="{{ route('admin.facilities.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.facilities.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-building"></i> Fasilitas
                    </a>
                    <a href="{{ route('admin.about.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.about.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-info-circle"></i> Tentang Sekolah
                    </a>
                    <a href="{{ route('admin.prestasis.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.prestasi.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-trophy"></i> Prestasi Siswa
                    </a>
                    <a href="{{ route('admin.consultations.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.consultations.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-envelope-open-text"></i> Pesan Masuk
                    </a>
                    <a href="{{ route('admin.settings.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fab fa-google"></i> Pengaturan PPDB
                    </a>
                </div>

                <div class="pt-4 border-t border-gray-800">
                    <p class="px-4 mb-2 text-xs font-semibold tracking-wider text-gray-500 uppercase">Sistem</p>
                    <a href="{{ route('admin.management-account.index') }}"
                        class="flex items-center px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.management-account.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                        <i class="w-5 mr-2 fas fa-users-cog"></i> Manajemen Akun
                    </a>
                </div>

            </nav>

            {{-- Scroll hint — bouncing arrow, hilang saat sudah di bawah --}}
            <div id="scroll-hint"
                class="absolute left-0 right-0 flex flex-col items-center pb-1 pointer-events-none bottom-1"
                style="z-index:10;">
                <span class="text-[10px] text-gray-500 font-semibold mb-0.5 tracking-widest uppercase">scroll</span>
                <i class="text-xs text-gray-400 fas fa-chevron-down scroll-hint-icon"></i>
            </div>

        </div>

        {{-- User info & logout — selalu terlihat, tidak ikut scroll --}}
        <div class="flex-shrink-0 p-4 bg-gray-800 border-t border-gray-700">
            <div class="flex items-center mb-3">
                <div class="flex items-center justify-center w-10 h-10 text-sm font-semibold text-white bg-blue-600 rounded-full shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="ml-3 overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400">{{ Auth::user()->role?->label() ?? 'Admin' }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-4 py-2 text-sm text-white transition-colors bg-red-600 rounded-lg hover:bg-red-700">
                    <i class="mr-2 fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </div>

    </aside>

    {{-- ═══════════ MAIN CONTENT ═══════════ --}}
    <div class="flex flex-col flex-1 overflow-hidden">

        {{-- Header --}}
        <div class="flex-shrink-0 p-4 bg-white border-b border-gray-200 shadow-sm">
            <h2 class="text-2xl font-bold text-gray-800">@yield('page_title', 'Dashboard')</h2>
            <p class="text-sm text-gray-600">@yield('page_subtitle', 'Kelola konten website sekolah')</p>
        </div>

        {{-- Content area --}}
        <div class="flex-1 p-6 overflow-auto">

            {{-- Flash: validation errors --}}
            @if($errors->any())
                <div id="flash-errors"
                    class="flex items-start justify-between gap-3 px-4 py-3 mb-4 text-red-800 border border-red-200 rounded-lg bg-red-50">
                    <div class="flex items-start gap-2">
                        <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                        <div>
                            <p class="mb-1 text-sm font-semibold">{{ count($errors) }} kesalahan ditemukan:</p>
                            <ul class="text-sm list-disc list-inside space-y-0.5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <button onclick="document.getElementById('flash-errors').remove()"
                        class="ml-2 text-lg leading-none text-red-400 hover:text-red-600 shrink-0">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- Flash: success --}}
            @if(session('success'))
                <div id="flash-success"
                    class="flex items-center justify-between gap-3 px-4 py-3 mb-4 text-green-800 border border-green-200 rounded-lg bg-green-50">
                    <div class="flex items-center gap-2">
                        <i class="text-green-600 fas fa-check-circle"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="document.getElementById('flash-success').remove()"
                        class="ml-4 text-lg leading-none text-green-500 hover:text-green-700 shrink-0">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            {{-- Flash: error --}}
            @if(session('error'))
                <div id="flash-error"
                    class="flex items-center justify-between gap-3 px-4 py-3 mb-4 text-red-800 border border-red-200 rounded-lg bg-red-50">
                    <div class="flex items-center gap-2">
                        <i class="text-red-600 fas fa-times-circle"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button onclick="document.getElementById('flash-error').remove()"
                        class="ml-4 text-lg leading-none text-red-500 hover:text-red-700 shrink-0">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @yield('content')

        </div>
    </div>
</div>

{{-- Flash auto-hide --}}
<script>
    setTimeout(function() {
        ['flash-success', 'flash-error'].forEach(function(id) {
            const el = document.getElementById(id);
            if (el) {
                el.style.transition = 'opacity 0.5s ease';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            }
        });
    }, 4000);
</script>

{{-- Sidebar scroll hint logic --}}
<script>
    (function () {
        const nav  = document.getElementById('sidebar-nav');
        const wrap = document.getElementById('sidebar-wrap');
        const hint = document.getElementById('scroll-hint');
        if (!nav || !wrap || !hint) return;

        function update() {
            const atBottom = nav.scrollTop + nav.clientHeight >= nav.scrollHeight - 8;
            wrap.classList.toggle('at-bottom', atBottom);
            hint.style.opacity = atBottom ? '0' : '1';
        }

        nav.addEventListener('scroll', update, { passive: true });

        // Saat load: cek apakah perlu scroll sama sekali
        setTimeout(function () {
            if (nav.scrollHeight <= nav.clientHeight + 8) {
                hint.style.display = 'none';
                wrap.classList.add('at-bottom');
            } else {
                update();
            }
        }, 150);
    })();
</script>

@stack('scripts')
</body>
</html>