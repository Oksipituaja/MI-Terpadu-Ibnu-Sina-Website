<div class="min-h-screen" style="background: #F0F4ED">

    {{-- Hero --}}
    <div class="relative overflow-hidden" style="background: linear-gradient(to bottom right, #15803d, #166534, #14532d)">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 rounded-full w-96 h-96 blur-3xl"
                style="background: #EAB308"></div>
            <div class="absolute bottom-0 left-0 -translate-x-1/2 translate-y-1/2 rounded-full w-72 h-72 blur-3xl"
                style="background: #86efac"></div>
        </div>
        <div class="relative max-w-4xl px-6 mx-auto py-14 md:py-20">
            <div class="flex items-center gap-2 mb-4 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Beranda</a>
                <i class="text-xs fas fa-chevron-right"></i>
                <span class="font-medium text-white">SPMB / PPDB</span>
            </div>
            <h1 class="mb-3 text-3xl font-bold text-white md:text-5xl">Pendaftaran Peserta Didik Baru</h1>
            <p class="max-w-xl text-base md:text-lg" style="color: #bbf7d0">
                Daftarkan putra/putri Anda di <span class="font-semibold" style="color: #EAB308">MI Terpadu Ibnu
                    Sina</span>
                dan jadikan mereka generasi muslim yang berilmu dan berakhlaqul karimah.
            </p>
        </div>
    </div>

    <div class="max-w-4xl px-6 mx-auto space-y-12 py-14">

        {{-- Alur Pendaftaran --}}
        <div>
            <div class="mb-8 text-center">
                <span class="block mb-2 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Cara
                    Mendaftar</span>
                <h2 class="text-2xl font-bold text-gray-900">Alur Pendaftaran Online</h2>
                <div class="w-12 h-1 mx-auto mt-3 rounded-full" style="background: #EAB308"></div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                @php
                    $alur = [
                        [
                            'step' => '01',
                            'icon' => 'fa-money-bill-wave',
                            'bgStyle' => 'background: #15803d',
                            'label' => 'Bayar Pendaftaran',
                            'desc' => 'Transfer Rp 100.000 ke BRI a.n. MI Terpadu Ibnu Sina',
                        ],
                        [
                            'step' => '02',
                            'icon' => 'fa-paper-plane',
                            'bgStyle' => 'background: #2563eb',
                            'label' => 'Konfirmasi',
                            'desc' => 'Kirim bukti ke Example Name · 081 234 567 890',
                        ],
                        [
                            'step' => '03',
                            'icon' => 'fa-key',
                            'bgStyle' => 'background: #7c3aed',
                            'label' => 'Terima Token',
                            'desc' => 'Dapatkan token & nomor pendaftaran',
                        ],
                        [
                            'step' => '04',
                            'icon' => 'fa-edit',
                            'bgStyle' => 'background: #EAB308',
                            'label' => 'Isi Formulir',
                            'desc' => 'Login & lengkapi data calon siswa',
                        ],
                        [
                            'step' => '05',
                            'icon' => 'fa-bell',
                            'bgStyle' => 'background: #dc2626',
                            'label' => 'Pengumuman',
                            'desc' => 'Tunggu hasil seleksi & info daftar ulang',
                        ],
                    ];
                @endphp
                @foreach ($alur as $item)
                    <div class="relative flex flex-col items-center p-5 text-center bg-white border border-gray-200 shadow-sm rounded-2xl">
                        <div class="flex items-center justify-center w-12 h-12 mb-3 rounded-xl"
                            style="{{ $item['bgStyle'] }}">
                            <i class="text-base fas {{ $item['icon'] }}" style="color: white"></i>
                        </div>
                        <span class="mb-1 text-xs font-black text-gray-300">{{ $item['step'] }}</span>
                        <p class="mb-1 text-sm font-bold text-gray-900">{{ $item['label'] }}</p>
                        <p class="text-xs leading-relaxed text-gray-500">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            {{-- Info Rekening --}}
            <div class="flex flex-col items-start gap-4 p-5 mt-5 border sm:flex-row sm:items-center rounded-2xl"
                style="background: #dcfce7; border-color: #15803d26">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl shrink-0" style="background: #15803d">
                    <i class="text-lg text-white fas fa-university"></i>
                </div>
                <div class="flex-1">
                    <p class="mb-0.5 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Rekening
                        Pembayaran</p>
                    <p class="text-base font-bold text-gray-900">Bank BRI · <span class="font-mono"
                            style="color: #15803d">5899-01-034638-53-0</span></p>
                    <p class="text-sm text-gray-600">a.n. <span class="font-semibold">MI Terpadu Ibnu Sina</span> ·
                        Biaya pendaftaran <span class="font-bold" style="color: #15803d">Rp 100.000</span></p>
                </div>
                <div class="text-sm text-gray-600">
                    <p class="mb-1 text-xs font-bold text-gray-500">Format konfirmasi:</p>
                    <code class="px-3 py-1.5 text-xs font-mono bg-white border rounded-lg"
                        style="border-color: #15803d26; color: #14532d">
                        Nama pengirim#nama calon siswa
                    </code>
                </div>
            </div>
        </div>

        {{-- Persyaratan --}}
        <div class="overflow-hidden bg-white border shadow-sm rounded-2xl" style="border-color: #15803d26">
            <div class="flex items-center gap-3 px-6 py-4" style="background: #15803d">
                <i class="text-white fas fa-clipboard-list"></i>
                <div>
                    <h3 class="font-bold text-white">Persyaratan Pendaftaran</h3>
                    <p class="text-xs" style="color: #86efac">Dokumen yang perlu disiapkan</p>
                </div>
            </div>
            @php
                $syarat = [
                    ['icon' => 'fa-heartbeat', 'text' => 'Sehat jasmani dan rohani'],
                    ['icon' => 'fa-image', 'text' => 'Pas foto berwarna ukuran 3×4 (3 lembar)'],
                    ['icon' => 'fa-baby', 'text' => 'Fotokopi Akta Kelahiran (3 lembar)'],
                    ['icon' => 'fa-users', 'text' => 'Fotokopi Kartu Keluarga (3 lembar)'],
                    ['icon' => 'fa-scroll', 'text' => 'Fotokopi Ijazah (jika sudah memiliki)'],
                    ['icon' => 'fa-money-bill', 'text' => 'Membayar Infaq Pendaftaran & Screening Rp 100.000'],
                    ['icon' => 'fa-folder', 'text' => 'Semua berkas fisik diserahkan saat daftar ulang (untuk pendaftar online)'],
                ];
            @endphp
            <div class="px-6 py-2">
                @foreach ($syarat as $s)
                    <div class="flex items-start gap-4 py-3 {{ !$loop->last ? 'border-b border-gray-100' : '' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg shrink-0 mt-0.5"
                            style="background: #15803d1a">
                            <i class="text-xs fas {{ $s['icon'] }}" style="color: #15803d"></i>
                        </div>
                        <span class="text-sm text-gray-700">{{ $s['text'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Kontak --}}
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="flex items-center gap-4 p-5 border rounded-2xl"
                style="background: #dcfce7; border-color: #15803d26">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl shrink-0" style="background: #15803d">
                    <i class="text-white fab fa-whatsapp"></i>
                </div>
                <div>
                    <p class="mb-0.5 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Admin</p>
                    <a href="https://api.whatsapp.com/send/?phone=6282323561617&text&type=phone_number&app_absent=0"
                        class="text-base font-bold text-gray-900 transition-colors hover:opacity-80">+62 823-2356-1617</a>
                    <p class="text-xs text-gray-500">Informasi & pertanyaan umum</p>
                </div>
            </div>
            <div class="flex items-center gap-4 p-5 border rounded-2xl"
                style="background: #dcfce7; border-color: #15803d26">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl shrink-0" style="background: #15803d">
                    <i class="text-white fab fa-whatsapp"></i>
                </div>
                <div>
                    <p class="mb-0.5 text-xs font-bold tracking-widest uppercase" style="color: #15803d">Konfirmasi
                        Pembayaran</p>
                    <a href="https://api.whatsapp.com/send/?phone=%2B6285225549694&text&type=phone_number&app_absent=0" target="_blank"
                        class="text-base font-bold text-gray-900 transition-colors hover:opacity-80">+62 852-2554-9694</a>
                    <p class="text-xs text-gray-500">(Bendahara) Ustadz Zul</p>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="flex items-center gap-4">
            <div class="flex-1 border-t border-gray-200"></div>
            <span class="px-4 py-1.5 text-xs font-bold rounded-full uppercase tracking-widest"
                style="color: #15803d; background: #dcfce7; border: 1px solid #15803d26">
                Formulir Pendaftaran Online
            </span>
            <div class="flex-1 border-t border-gray-200"></div>
        </div>

        {{-- ✅ GOOGLE FORM SECTION --}}
        @if($googleFormUrl)

            {{-- Tombol redirect --}}
            <div class="text-center">
                <a href="{{ $googleFormUrl }}" target="_blank"
                    class="inline-flex items-center gap-3 px-8 py-4 text-base font-bold text-white rounded-2xl transition-all hover:-translate-y-1 hover:shadow-xl"
                    style="background: #15803d; box-shadow: 0 6px 20px #15803d44">
                    <i class="fab fa-google text-lg"></i>
                    Isi Formulir Pendaftaran Online
                    <i class="fas fa-external-link-alt text-sm opacity-70"></i>
                </a>
                <p class="mt-2 text-xs text-gray-400">Formulir akan terbuka di tab baru · atau isi langsung di bawah</p>
            </div>

            {{-- Embed iframe Google Form --}}
            <div class="overflow-hidden bg-white border shadow-sm rounded-2xl" style="border-color: #15803d26">
                <div class="flex items-center gap-3 px-6 py-4 border-b" style="background: #F0F4ED">
                    <i class="fab fa-google text-lg" style="color: #15803d"></i>
                    <div>
                        <h3 class="font-bold text-gray-800">Formulir Pendaftaran Online</h3>
                        <p class="mt-0.5 text-xs text-gray-500">Isi langsung di bawah ini atau klik tombol di atas</p>
                    </div>
                </div>
                <iframe
                    src="{{ $googleFormUrl }}?embedded=true"
                    width="100%"
                    height="900"
                    frameborder="0"
                    marginheight="0"
                    marginwidth="0"
                    class="w-full">
                    Memuat formulir…
                </iframe>
            </div>

        @else

            {{-- Pendaftaran belum dibuka --}}
            <div class="flex flex-col items-center justify-center gap-5 py-16 text-center bg-white border shadow-sm rounded-2xl"
                style="border-color: #15803d26">
                <div class="flex items-center justify-center w-16 h-16 rounded-2xl" style="background: #fef9c3">
                    <i class="text-2xl fas fa-clock" style="color: #ca8a04"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Pendaftaran Belum Dibuka</h3>
                    <p class="mt-1 text-sm text-gray-500 max-w-xs mx-auto">
                        Formulir pendaftaran online belum tersedia saat ini. Pantau terus halaman ini atau hubungi kami untuk informasi lebih lanjut.
                    </p>
                </div>
                <a href="https://api.whatsapp.com/send/?phone=6282323561617&text&type=phone_number&app_absent=0" target="_blank"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl transition hover:-translate-y-0.5"
                    style="background: #16a34a; box-shadow: 0 4px 12px #16a34a33">
                    <i class="fab fa-whatsapp"></i> Tanya via WhatsApp
                </a>
            </div>

        @endif

    </div>
</div>