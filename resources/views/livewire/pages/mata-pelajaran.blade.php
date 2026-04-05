<div class="min-h-screen" style="background: #F0F4ED; font-family: 'Segoe UI', sans-serif;">

    {{-- ===================== HERO SECTION ===================== --}}
    <div class="relative overflow-hidden"
        style="background: linear-gradient(135deg, #14532d 0%, #166534 50%, #15803d 100%);">
        {{-- Decorative Circles --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute rounded-full opacity-10"
                style="width: 400px; height: 400px; background: #EAB308; top: -100px; right: -80px; filter: blur(60px);">
            </div>
            <div class="absolute rounded-full opacity-10"
                style="width: 300px; height: 300px; background: #86efac; bottom: -80px; left: -60px; filter: blur(50px);">
            </div>
        </div>
        {{-- Grid Pattern Overlay --}}
        <div class="absolute inset-0 opacity-5"
            style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        <div class="relative max-w-6xl px-6 py-16 mx-auto md:py-24">
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 mb-6 text-sm" style="color: #86efac;">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white flex items-center gap-1.5">
                    <i class="text-xs fas fa-home"></i>
                    <span>Beranda</span>
                </a>
                <i class="text-xs fas fa-chevron-right opacity-60"></i>
                <span class="font-semibold text-white">Mata Pelajaran</span>
            </div>

            {{-- Title --}}
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mb-4"
                        style="background: rgba(234,179,8,0.2); color: #fde047; border: 1px solid rgba(234,179,8,0.3);">
                        <i class="text-xs fas fa-book-open"></i>
                        Kurikulum Terintegrasi
                    </div>
                    <h1 class="mb-3 text-3xl font-extrabold leading-tight text-white md:text-5xl">Mata Pelajaran</h1>
                    <p class="max-w-xl text-base leading-relaxed md:text-lg" style="color: #bbf7d0;">
                        Kurikulum terintegrasi antara
                        <span class="font-bold" style="color: #fde047;">Pendidikan Nasional</span>
                        dan
                        <span class="font-bold" style="color: #fde047;">Kementerian Agama</span>
                        untuk generasi muslim yang unggul.
                    </p>
                </div>
                {{-- Stats badges --}}
                <div class="flex flex-wrap gap-3 md:flex-nowrap shrink-0">
                    <div class="flex flex-col items-center justify-center px-5 py-3 text-center rounded-2xl"
                        style="background: rgba(255,255,255,0.12); backdrop-filter: blur(6px); border: 1px solid rgba(255,255,255,0.15); min-width: 90px;">
                        <span class="text-2xl font-extrabold text-white">13</span>
                        <span class="text-xs mt-0.5" style="color: #bbf7d0;">Mapel</span>
                    </div>
                    <div class="flex flex-col items-center justify-center px-5 py-3 text-center rounded-2xl"
                        style="background: rgba(255,255,255,0.12); backdrop-filter: blur(6px); border: 1px solid rgba(255,255,255,0.15); min-width: 90px;">
                        <span class="text-2xl font-extrabold text-white">3</span>
                        <span class="text-xs mt-0.5" style="color: #bbf7d0;">Juz Target</span>
                    </div>
                    <div class="flex flex-col items-center justify-center px-5 py-3 text-center rounded-2xl"
                        style="background: rgba(255,255,255,0.12); backdrop-filter: blur(6px); border: 1px solid rgba(255,255,255,0.15); min-width: 90px;">
                        <span class="text-2xl font-extrabold text-white">6+</span>
                        <span class="text-xs mt-0.5" style="color: #bbf7d0;">Ekskul</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <div class="max-w-6xl px-6 mx-auto space-y-16 py-14">

        {{-- ---- INFO KURIKULUM BANNER ---- --}}
        <div class="flex flex-col items-start gap-5 p-6 border sm:flex-row sm:items-center rounded-2xl"
            style="background: linear-gradient(to right, #dcfce7, #f0fdf4); border-color: #86efac;">
            <div class="flex items-center justify-center shadow-md w-14 h-14 rounded-xl shrink-0"
                style="background: linear-gradient(135deg, #15803d, #166534);">
                <i class="text-xl text-white fas fa-graduation-cap"></i>
            </div>
            <div class="flex-1">
                <span class="block mb-1 text-xs font-bold tracking-widest uppercase" style="color: #15803d;">Kurikulum
                    yang Digunakan</span>
                <h2 class="mb-1 text-xl font-extrabold" style="color: #14532d;">Kurikulum Terintegrasi</h2>
                <p class="text-sm leading-relaxed text-gray-600">
                    MI Terpadu Ibnu Sina menerapkan
                    <span class="font-semibold" style="color: #15803d;">Kurikulum Pendidikan Nasional</span>
                    yang dipadukan dengan
                    <span class="font-semibold" style="color: #15803d;">Kurikulum Kementerian Agama</span>
                    dan <span class="font-semibold text-indigo-700">Muatan Lokal</span> —
                    membentuk generasi yang berilmu, beriman, dan berkarya.
                </p>
            </div>
        </div>

        {{-- ===================== DAFTAR MATA PELAJARAN ===================== --}}
        <div>
            <div class="mb-10 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d;">Daftar Mata
                    Pelajaran</span>
                <h2 class="text-2xl font-extrabold md:text-3xl" style="color: #14532d;">Mata Pelajaran MI Terpadu Ibnu
                    Sina</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308;"></div>
            </div>

            {{-- Row 1: Nasional + Agama (equal height) --}}
            <div class="grid items-start gap-5 md:grid-cols-2">

                {{-- Kurikulum Nasional --}}
                @php
                    $mapelNasional = [
                        'Pendidikan Pancasila & Kewarganegaraan',
                        'Bahasa Indonesia',
                        'Matematika',
                        'Ilmu Pengetahuan Alam & Sosial (IPAS)',
                        'Pendidikan Jasmani & Olahraga (PJOK)',
                        'Seni Budaya dan Prakarya',
                    ];
                    $mapelAgama = [
                        'Al-Qur\'an Hadits',
                        'Aqidah Akhlaq',
                        'Fiqih',
                        'Sejarah Kebudayaan Islam (SKI)',
                        'Bahasa Arab',
                    ];
                @endphp

                <div class="flex flex-col h-full overflow-hidden bg-white border shadow-sm rounded-2xl"
                    style="border-color: #15803d26;">
                    <div class="flex items-center gap-3 px-6 py-4"
                        style="background: linear-gradient(135deg, #15803d, #166534);">
                        <div class="flex items-center justify-center rounded-lg w-9 h-9"
                            style="background: rgba(255,255,255,0.15);">
                            <i class="text-sm text-white fas fa-flag"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Kurikulum Pendidikan Nasional</h3>
                            <p class="text-xs mt-0.5" style="color: #bbf7d0;">Mata pelajaran umum semua jenjang</p>
                        </div>
                    </div>
                    <div class="flex-1 px-6 py-2">
                        @foreach ($mapelNasional as $i => $nama)
                            <div
                                class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                <span class="w-6 text-xs font-extrabold text-center tabular-nums shrink-0"
                                    style="color: #15803d;">
                                    {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="w-px h-4 bg-gray-200 shrink-0"></span>
                                <span class="text-sm font-medium text-gray-800">{{ $nama }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-2 px-6 py-3 border-t border-gray-100"
                        style="background: #f0fdf4;">
                        <i class="text-xs fas fa-list-ol" style="color: #15803d;"></i>
                        <p class="text-xs text-gray-500">Total <span class="font-bold"
                                style="color: #15803d;">{{ count($mapelNasional) }}</span> mata pelajaran</p>
                    </div>
                </div>

                {{-- Kurikulum Agama --}}
                <div class="flex flex-col h-full overflow-hidden bg-white border shadow-sm rounded-2xl"
                    style="border-color: #15803d26;">
                    <div class="flex items-center gap-3 px-6 py-4"
                        style="background: linear-gradient(135deg, #166534, #14532d);">
                        <div class="flex items-center justify-center rounded-lg w-9 h-9"
                            style="background: rgba(255,255,255,0.15);">
                            <i class="text-sm text-white fas fa-mosque"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Kurikulum Kementerian Agama</h3>
                            <p class="text-xs mt-0.5" style="color: #bbf7d0;">Pendidikan Islam terpadu</p>
                        </div>
                    </div>
                    <div class="flex-1 px-6 py-2">
                        @foreach ($mapelAgama as $i => $nama)
                            <div
                                class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                <span class="w-6 text-xs font-extrabold text-center tabular-nums shrink-0"
                                    style="color: #15803d;">
                                    {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <span class="w-px h-4 bg-gray-200 shrink-0"></span>
                                <span class="text-sm font-medium text-gray-800">{{ $nama }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-2 px-6 py-3 border-t border-gray-100"
                        style="background: #f0fdf4;">
                        <i class="text-xs fas fa-list-ol" style="color: #15803d;"></i>
                        <p class="text-xs text-gray-500">Total <span class="font-bold"
                                style="color: #15803d;">{{ count($mapelAgama) }}</span> mata pelajaran</p>
                    </div>
                </div>
            </div>

            {{-- Row 2: Muatan Lokal + Al-Qur'an --}}
            <div class="grid items-stretch gap-5 mt-5 md:grid-cols-2">

                {{-- Muatan Lokal --}}
                <div class="flex flex-col overflow-hidden bg-white border shadow-sm border-amber-200 rounded-2xl">
                    <div class="flex items-center gap-3 px-6 py-4"
                        style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                        <div class="flex items-center justify-center rounded-lg w-9 h-9"
                            style="background: rgba(255,255,255,0.2);">
                            <i class="text-sm text-white fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Muatan Lokal</h3>
                            <p class="text-xs text-amber-100">Kearifan lokal & bahasa internasional</p>
                        </div>
                    </div>
                    <div class="flex-1 px-6 py-4 space-y-3">
                        @foreach ([['icon' => 'fa-language', 'nama' => 'Bahasa Jawa', 'desc' => 'Pelestarian budaya & bahasa daerah'], ['icon' => 'fa-globe', 'nama' => 'Bahasa Inggris', 'desc' => 'Komunikasi internasional sejak dini']] as $item)
                            <div class="flex items-center gap-4 p-4 border border-amber-100 rounded-xl bg-amber-50">
                                <div class="flex items-center justify-center w-10 h-10 rounded-xl shrink-0"
                                    style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                                    <i class="fas {{ $item['icon'] }} text-sm text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $item['nama'] }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $item['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Pembelajaran Al-Qur'an --}}
                <div class="flex flex-col overflow-hidden bg-white border border-indigo-200 shadow-sm rounded-2xl">
                    <div class="flex items-center gap-3 px-6 py-4"
                        style="background: linear-gradient(135deg, #4f46e5, #3730a3);">
                        <div class="flex items-center justify-center rounded-lg w-9 h-9"
                            style="background: rgba(255,255,255,0.15);">
                            <i class="text-sm text-white fas fa-book-open"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Pembelajaran Al-Qur'an</h3>
                            <p class="text-xs text-indigo-200">Target 3 Juz hafalan</p>
                        </div>
                    </div>
                    <div class="flex-1 px-6 py-4 space-y-3">
                        <div class="flex items-start gap-4 p-4 border border-indigo-100 rounded-xl bg-indigo-50">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl shrink-0 mt-0.5"
                                style="background: linear-gradient(135deg, #4f46e5, #3730a3);">
                                <i class="text-sm text-white fas fa-spell-check"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Baca Tulis & Tahsin</p>
                                <p class="text-xs text-gray-500 mt-0.5">Menggunakan <span
                                        class="font-semibold text-indigo-700">Metode UMMI</span></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 border border-indigo-100 rounded-xl bg-indigo-50">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl shrink-0 mt-0.5"
                                style="background: linear-gradient(135deg, #4f46e5, #3730a3);">
                                <i class="text-sm text-white fas fa-star"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Hafalan Al-Qur'an (Tahfidz)</p>
                                <p class="text-xs text-gray-500 mt-0.5">Metode <span
                                        class="font-semibold text-indigo-700">Al Qosimi</span> & Tastmur — target <span
                                        class="font-bold text-green-600">3 Juz</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== KEUNGGULAN MADRASAH ===================== --}}
        <div>
            <div class="mb-10 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d;">Yang
                    Membedakan Kami</span>
                <h2 class="text-2xl font-extrabold md:text-3xl" style="color: #14532d;">Keunggulan Madrasah</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308;"></div>
            </div>

            @php
                $keunggulan = [
                    [
                        'icon' => 'fa-heart',
                        'gradient' => 'linear-gradient(135deg,#ef4444,#dc2626)',
                        'label' => 'Pembinaan Akhlak',
                        'desc' => 'Penanaman nilai-nilai karakter islami sejak dini dalam setiap kegiatan belajar.',
                    ],
                    [
                        'icon' => 'fa-pray',
                        'gradient' => 'linear-gradient(135deg,#15803d,#166534)',
                        'label' => 'Praktik Ibadah Harian',
                        'desc' => 'Dzikir harian, Sholat Dhuha, dan Sholat berjamaah sebagai pembiasaan rutin.',
                    ],
                    [
                        'icon' => 'fa-piggy-bank',
                        'gradient' => 'linear-gradient(135deg,#f59e0b,#d97706)',
                        'label' => 'Pendidikan Finansial',
                        'desc' => 'Melatih kebiasaan infaq dan menabung untuk membentuk jiwa sosial siswa.',
                    ],
                    [
                        'icon' => 'fa-comments',
                        'gradient' => 'linear-gradient(135deg,#2563eb,#1d4ed8)',
                        'label' => 'Komunikasi Orang Tua',
                        'desc' => 'Buku Komunikasi interaktif antara orang tua dan wali kelas.',
                    ],
                    [
                        'icon' => 'fa-quran',
                        'gradient' => 'linear-gradient(135deg,#4f46e5,#3730a3)',
                        'label' => 'Target Tahfidz 3 Juz',
                        'desc' => 'Program hafalan Al-Qur\'an terstruktur menggunakan Metode Al Qosimi.',
                    ],
                    [
                        'icon' => 'fa-sun',
                        'gradient' => 'linear-gradient(135deg,#ea580c,#c2410c)',
                        'label' => 'Full Day School',
                        'desc' => 'Konsep sekolah sehari penuh dengan keseimbangan akademik dan pembentukan karakter.',
                    ],
                ];
            @endphp

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($keunggulan as $item)
                    <div class="flex items-start gap-4 p-5 transition-shadow bg-white border shadow-sm rounded-2xl hover:shadow-md"
                        style="border-color: #15803d1a;">
                        <div class="flex items-center justify-center w-11 h-11 rounded-xl shrink-0"
                            style="background: {{ $item['gradient'] }};">
                            <i class="fas {{ $item['icon'] }} text-sm text-white"></i>
                        </div>
                        <div>
                            <p class="mb-1 text-sm font-bold" style="color: #14532d;">{{ $item['label'] }}</p>
                            <p class="text-xs leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===================== PROGRAM & EKSKUL ===================== --}}
        <div>
            <div class="mb-10 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d;">Kegiatan
                    Tambahan</span>
                <h2 class="text-2xl font-extrabold md:text-3xl" style="color: #14532d;">Program Unggulan &
                    Ekstrakurikuler</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308;"></div>
            </div>

            <div class="grid items-start gap-5 md:grid-cols-2">

                {{-- Program Penunjang --}}
                @php
                    $programPenunjang = [
                        ['icon' => 'fa-moon', 'nama' => 'MABIT', 'desc' => 'Malam Bina Iman dan Taqwa'],
                        [
                            'icon' => 'fa-route',
                            'nama' => 'Around Field Trip',
                            'desc' => 'Kunjungan edukatif & wisata belajar',
                        ],
                        ['icon' => 'fa-swimmer', 'nama' => 'Berenang', 'desc' => 'Olahraga air & ketangkasan'],
                        ['icon' => 'fa-horse', 'nama' => 'Latihan Berkurban', 'desc' => 'Pendidikan ibadah qurban'],
                        [
                            'icon' => 'fa-scroll',
                            'nama' => 'Wisuda Tahfidz',
                            'desc' => 'Perayaan capaian hafalan Al-Qur\'an',
                        ],
                        ['icon' => 'fa-flask', 'nama' => 'Kelas SAINS', 'desc' => 'Pembelajaran sains eksperimental'],
                    ];
                @endphp
                <div class="flex flex-col overflow-hidden bg-white border shadow-sm rounded-2xl"
                    style="border-color: #15803d26;">
                    <div class="flex items-center gap-3 px-6 py-4"
                        style="background: linear-gradient(135deg, #15803d, #166534);">
                        <div class="flex items-center justify-center rounded-lg w-9 h-9"
                            style="background: rgba(255,255,255,0.15);">
                            <i class="text-sm text-white fas fa-star"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Program Penunjang</h3>
                            <p class="text-xs mt-0.5" style="color: #bbf7d0;">Kegiatan pembentukan karakter</p>
                        </div>
                    </div>
                    <div class="px-6 py-2">
                        @foreach ($programPenunjang as $prog)
                            <div
                                class="flex items-center gap-4 py-3.5 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                                <div class="flex items-center justify-center w-9 h-9 rounded-xl shrink-0"
                                    style="background: #dcfce7;">
                                    <i class="fas {{ $prog['icon'] }} text-xs" style="color: #15803d;"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold" style="color: #14532d;">{{ $prog['nama'] }}</p>
                                    <p class="text-xs text-gray-400">{{ $prog['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Pengembangan Diri --}}
                <div class="flex flex-col overflow-hidden bg-white border border-green-200 shadow-sm rounded-2xl">
                    <div class="flex items-center gap-3 px-6 py-4"
                        style="background: linear-gradient(135deg, #16a34a, #15803d);">
                        <div class="flex items-center justify-center rounded-lg w-9 h-9"
                            style="background: rgba(255,255,255,0.15);">
                            <i class="text-sm text-white fas fa-trophy"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-white">Pengembangan Diri</h3>
                            <p class="text-xs text-green-100">Ekstrakurikuler pilihan</p>
                        </div>
                    </div>
                    <div class="flex-1 px-6 py-5 space-y-3">
                        <div class="flex items-center gap-4 p-4 border border-green-100 rounded-xl bg-green-50">
                            <div class="flex items-center justify-center w-11 h-11 rounded-xl shrink-0"
                                style="background: linear-gradient(135deg, #16a34a, #15803d);">
                                <i class="text-sm text-white fas fa-campground"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Kepramukaan</p>
                                <p class="text-xs text-gray-500 mt-0.5">Membentuk karakter disiplin, mandiri, dan
                                    gotong royong</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 p-4 border border-green-100 rounded-xl bg-green-50">
                            <div class="flex items-center justify-center w-11 h-11 rounded-xl shrink-0"
                                style="background: linear-gradient(135deg, #16a34a, #15803d);">
                                <i class="text-sm text-white fas fa-fist-raised"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">Bela Diri (Silat)</p>
                                <p class="text-xs text-gray-500 mt-0.5">Seni bela diri tradisional untuk fisik dan
                                    mental</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 pb-5">
                        <div class="p-4 border border-indigo-100 rounded-xl bg-indigo-50">
                            <div class="flex items-start gap-3">
                                <i class="mt-1 text-indigo-300 fas fa-quote-left shrink-0"></i>
                                <p class="text-xs italic leading-relaxed text-gray-600">
                                    "Mendidik itu seperti menanam pohon. Kami suburkan dengan cinta, doa, dan teladan.
                                    Setiap anak terlahir unik, maka kami menangani mereka dengan cara yang berbeda agar
                                    tumbuh menjadi warna-warni dunia."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== CTA BANNER ===================== --}}
        <div class="relative flex flex-col items-start gap-5 overflow-hidden sm:flex-row sm:items-center p-7 rounded-2xl"
            style="background: linear-gradient(135deg, #14532d 0%, #15803d 60%, #166534 100%);">
            <div class="absolute inset-0 opacity-5"
                style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 24px 24px;">
            </div>
            <div class="relative flex items-center justify-center w-12 h-12 rounded-xl shrink-0"
                style="background: rgba(255,255,255,0.15);">
                <i class="text-xl text-white fas fa-users"></i>
            </div>
            <div class="relative flex-1">
                <h3 class="text-base font-extrabold text-white mb-1.5">Tertarik Mendaftarkan Putra/Putri Anda?</h3>
                <p class="text-sm leading-relaxed" style="color: #bbf7d0;">
                    MI Terpadu Ibnu Sina membuka pendaftaran peserta didik baru setiap tahun ajaran.
                    Jadikan anak Anda bagian dari generasi muslim yang berilmu, berkarya, dan berakhlaqul karimah.
                </p>
            </div>
            <a href="{{ route('ppdb') }}"
                class="relative inline-flex items-center gap-2 px-6 py-3 font-extrabold text-sm rounded-xl transition-transform hover:-translate-y-0.5 shrink-0 shadow-lg"
                style="background: #EAB308; color: #14532d; box-shadow: 0 4px 20px rgba(234,179,8,0.4);">
                <i class="fas fa-graduation-cap"></i> Daftar Sekarang
            </a>
        </div>

    </div>
</div>
