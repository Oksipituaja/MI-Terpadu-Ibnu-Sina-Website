<div>

{{-- ═══════════ HERO — Full Background Image ═══════════ --}}
<section class="relative overflow-hidden" style="min-height:92vh;">

    {{-- Background Image --}}
    <div class="absolute inset-0">
        @if ($heroImage && $heroImage->featured_image)
            <img src="{{ url('/files/' . $heroImage->featured_image) }}"
                alt="{{ config('app.name') }}"
                class="object-cover object-center w-full h-full">
        @else
            <img src="{{ asset('hero_image.png') }}"
                alt="{{ config('app.name') }}"
                class="object-cover object-center w-full h-full">
        @endif

        <div class="absolute inset-0"
            style="background:linear-gradient(
                to bottom,
                rgba(5,25,12,0.70) 0%,
                rgba(5,25,12,0.38) 45%,
                rgba(5,25,12,0.82) 100%
            )"></div>

        <div class="absolute inset-0 pointer-events-none"
            style="background:
                radial-gradient(ellipse at 70% 10%, rgba(234,179,8,0.10) 0%, transparent 55%),
                radial-gradient(ellipse at 20% 90%, rgba(21,128,61,0.15) 0%, transparent 50%)">
        </div>
    </div>

    {{-- Content wrapper — flex column, full height --}}
    <div class="relative z-10 flex flex-col items-center justify-center px-6 text-center sm:px-8"
        style="min-height:92vh; padding-top:100px; padding-bottom:80px; gap:0;">

        {{-- 1. Badge --}}
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full"
            style="background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.20);backdrop-filter:blur(10px);margin-bottom:28px;">
            <span class="flex-shrink-0 w-2 h-2 bg-green-400 rounded-full"
                style="box-shadow:0 0 0 4px rgba(74,222,128,.20)"></span>
            <span class="text-[11px] font-bold tracking-[.15em] uppercase text-green-100">Terakreditasi B</span>
        </div>

        {{-- 2. Headline --}}
        <div style="margin-bottom:20px;">
            <h1 class="font-black tracking-tight text-white"
                style="font-size:clamp(2.4rem,5.5vw,4.2rem);line-height:1.08;margin-bottom:6px;">
                Membentuk Generasi
            </h1>
            <h1 class="font-black tracking-tight"
                style="font-size:clamp(2.4rem,5.5vw,4.2rem);line-height:1.08;background:linear-gradient(90deg,#EAB308 20%,#fde68a 80%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                Unggul &amp; Berkarakter
            </h1>
        </div>

        {{-- 3. Subtext --}}
        <p class="max-w-lg" style="font-size:15.5px;line-height:1.75;color:rgba(255,255,255,.68);margin-bottom:36px;">
            {{ config('app.name') }} berkomitmen memberikan pendidikan berkualitas
            dengan fasilitas modern dan tenaga pendidik profesional.
        </p>

        {{-- 4. CTA Buttons --}}
        <div class="flex flex-wrap items-center justify-center gap-3" style="margin-bottom:48px;">
            <a href="{{ route('ppdb') }}"
                class="inline-flex items-center gap-2 text-sm font-extrabold rounded-xl transition-all duration-200 hover:-translate-y-0.5 active:scale-[.98]"
                style="padding:14px 28px;background:#EAB308;color:#14532d;box-shadow:0 5px 22px rgba(234,179,8,.42)">
                Daftar Sekarang
                <i class="text-xs fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('about') }}"
                class="inline-flex items-center gap-2 text-sm font-bold rounded-xl transition-all duration-200 hover:-translate-y-0.5 active:scale-[.98]"
                style="padding:14px 28px;background:rgba(255,255,255,.10);border:1px solid rgba(255,255,255,.28);color:#fff;backdrop-filter:blur(8px)">
                Pelajari Lebih Lanjut
                <i class="text-xs fas fa-arrow-right"></i>
            </a>
        </div>

        {{-- 5. Divider --}}
        <div style="width:48px;height:1px;background:rgba(255,255,255,.18);margin-bottom:36px;"></div>

        {{-- 6. Stats Bar --}}
        <div class="inline-flex overflow-hidden rounded-2xl"
            style="border:1px solid rgba(255,255,255,.12);backdrop-filter:blur(14px);background:rgba(0,0,0,.28);">
            @foreach ([['357+', 'Siswa Aktif'], ['35+', 'Guru Profesional'], ['19+', 'Tahun Berpengalaman']] as [$num, $label])
                <div class="flex flex-col items-center justify-center text-center"
                    style="padding:18px 36px;{{ !$loop->last ? 'border-right:1px solid rgba(255,255,255,.10);' : '' }}">
                    <span class="font-black text-white" style="font-size:1.75rem;line-height:1;letter-spacing:-0.02em;">
                        {{ $num }}
                    </span>
                    <span style="font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;margin-top:7px;color:rgba(255,255,255,.45);">
                        {{ $label }}
                    </span>
                </div>
            @endforeach
        </div>

    </div>

    {{-- Badge Akreditasi — FIXED position supaya tidak terdorong layout --}}
    <div style="position:absolute;bottom:28px;right:28px;z-index:20;display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:16px;background:rgba(255,255,255,.96);box-shadow:0 8px 30px rgba(0,0,0,.18);border:1px solid rgba(21,128,61,.10);">
        <div style="display:flex;align-items:center;justify-content:center;flex-shrink:0;width:36px;height:36px;border-radius:50%;background:#15803d;box-shadow:0 3px 10px rgba(21,128,61,.38);">
            <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.6" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div>
            <p style="font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.12em;color:#9ca3af;line-height:1;margin-bottom:4px;">Status Resmi</p>
            <p style="font-size:13px;font-weight:900;color:#111827;line-height:1;">Terakreditasi B</p>
        </div>
    </div>

</section>

    


    {{-- ═══════════ SAMBUTAN ═══════════ --}}
    @if ($principalGreeting?->title)
        <section id="sambutan" class="relative py-20 overflow-hidden bg-white">
            <div class="absolute top-0 right-0 rounded-full pointer-events-none w-96 h-96"
                style="background:radial-gradient(circle,rgba(21,128,61,.05),transparent);transform:translate(35%,-35%)">
            </div>

            <div class="max-w-screen-xl px-6 mx-auto">
                <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-12 lg:gap-16">

                    <div class="flex justify-center lg:col-span-5">
                        <div class="relative">
                            <div class="absolute rounded-[26px] border-2 border-dashed border-[#15803d]/15"
                                style="inset:-16px;transform:rotate(2.5deg)"></div>
                            <div class="relative w-56 h-72 md:w-64 md:h-80 rounded-[22px] overflow-hidden border-4 border-white bg-[#dcfce7]"
                                style="box-shadow:0 16px 48px rgba(0,0,0,.12)">
                                @if ($principalGreeting?->featured_image)
                                    <img src="{{ url('/files/' . $principalGreeting->featured_image) }}"
                                        alt="{{ $principalGreeting->principal_name ?? 'Kepala Sekolah' }}"
                                        class="object-cover object-top w-full h-full">
                                @else
                                    <div class="flex flex-col items-center justify-center w-full h-full gap-3"
                                        style="background:linear-gradient(145deg,#dcfce7,#bbf7d0)">
                                        <div
                                            class="w-16 h-16 rounded-full flex items-center justify-center bg-[#15803d]/15">
                                            <i class="fas fa-user-tie text-3xl text-[#4ade80]"></i>
                                        </div>
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-[#4ade80]">Foto
                                            Belum Tersedia</p>
                                    </div>
                                @endif
                                <div class="absolute inset-x-0 bottom-0 px-5 pt-10 pb-4"
                                    style="background:linear-gradient(to top,rgba(14,83,45,.88),transparent)">
                                    <p class="text-white font-extrabold text-[15px] leading-tight">
                                        {{ $principalGreeting?->principal_name ?? 'Kepala Sekolah' }}
                                    </p>
                                    <p class="text-xs text-[#86efac] italic mt-1">
                                        Kepala Sekolah {{ config('app.name') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-6 lg:col-span-7">
                        <div>
                            <span
                                class="inline-block px-3.5 py-1.5 text-[10px] font-extrabold uppercase tracking-[.18em] rounded-full bg-[#15803d]/10 text-[#15803d] mb-4">
                                Sambutan Kepala Sekolah
                            </span>
                            <h2
                                class="text-[1.9rem] lg:text-[2.1rem] font-extrabold text-gray-900 leading-snug tracking-tight">
                                {{ $principalGreeting?->title }}
                            </h2>
                        </div>
                        <div
                            class="p-5 rounded-2xl bg-[#f8fdf9] border border-[#15803d]/10 border-l-4 border-l-[#15803d]">
                            <p class="text-[15px] leading-[1.85] text-gray-600 italic">
                                "{!! Str::limit(strip_tags($principalGreeting?->content ?? ''), 450) !!}"
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('about') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 text-sm font-bold text-white rounded-xl transition-all hover:-translate-y-0.5"
                                style="background:#15803d;box-shadow:0 4px 16px rgba(21,128,61,.3)">
                                Pelajari Lebih Lanjut
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    @endif

    {{-- ═══════════ GURU ═══════════ --}}
    <section id="guru" class="py-20 bg-[#F0F4ED]">
        <div class="max-w-screen-xl px-6 mx-auto">
            <div class="max-w-xl mx-auto text-center mb-14">
                <span class="text-[11px] font-extrabold uppercase tracking-[.18em] text-[#15803d]">Tim Kami</span>
                <h2 class="mt-3 mb-3 text-[2rem] lg:text-[2.2rem] font-extrabold text-[#14532d] tracking-tight">Tenaga
                    Pendidik & Pengajar</h2>
                <p class="text-[15px] text-gray-500 leading-relaxed">Guru berpengalaman dan berdedikasi tinggi siap
                    membimbing potensi setiap siswa.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($teachers as $teacher)
                    <div class="flex flex-col items-center text-center px-8 py-9 rounded-2xl bg-white border border-[#15803d]/10 transition-all hover:-translate-y-1"
                        style="box-shadow:0 2px 12px rgba(21,128,61,.06)">
                        <div class="w-[88px] h-[88px] rounded-full overflow-hidden mb-5 flex-shrink-0"
                            style="background:linear-gradient(135deg,#15803d,#22c55e);box-shadow:0 6px 18px rgba(21,128,61,.26)">
                            @if ($teacher->featured_image)
                                <img src="{{ url('/files/' . $teacher->featured_image) }}"
                                    alt="{{ $teacher->name }}" class="object-cover w-full h-full">
                            @else
                                <div class="flex items-center justify-center w-full h-full">
                                    <i class="text-4xl text-white fas fa-chalkboard-user"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-[15px] font-extrabold text-[#14532d]">{{ $teacher->name ?? 'Guru' }}</h3>
                        <p class="text-xs font-semibold text-[#15803d] mt-1.5">{{ $teacher->subject ?? 'Pendidik' }}
                        </p>
                    </div>
                @empty
                    <div class="py-10 text-center text-gray-400 col-span-full">Profil guru sedang dipersiapkan</div>
                @endforelse
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('teachers') }}"
                    class="inline-flex items-center gap-2 px-8 py-3 text-sm font-bold text-white rounded-xl transition-all hover:-translate-y-0.5"
                    style="background:#15803d;box-shadow:0 4px 16px rgba(21,128,61,.28)">
                    Lihat Semua Guru <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ═══════════ BERITA ═══════════ --}}
    <section id="berita" class="py-20 bg-white border-t border-[#e8f5e9]">
        <div class="max-w-screen-xl px-6 mx-auto">
            <div class="flex flex-col justify-between gap-4 mb-12 sm:flex-row sm:items-end">
                <div>
                    <span class="text-[11px] font-extrabold uppercase tracking-[.18em] text-[#15803d]">Berita
                        Terkini</span>
                    <h2 class="mt-2 text-[2rem] lg:text-[2.2rem] font-extrabold text-[#14532d] tracking-tight">Berita &
                        Pengumuman</h2>
                </div>
                <a href="{{ route('news') }}?tab=agenda"
                    class="inline-flex items-center gap-1.5 text-[13px] font-bold text-[#15803d] px-4 py-2 rounded-lg border border-[#15803d]/18 hover:bg-[#15803d]/[.06] transition-colors flex-shrink-0">
                    Lihat Semua <i class="text-xs fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($latestNews as $news)
                    <article
                        class="flex flex-col h-full overflow-hidden transition-all bg-white border border-gray-100 rounded-2xl hover:-translate-y-1 hover:shadow-lg"
                        style="box-shadow:0 1px 8px rgba(0,0,0,.05)">
                        <div class="h-[200px] overflow-hidden flex-shrink-0 bg-gray-100">
                            @if ($news->featured_image)
                                <img src="{{ url('/files/' . $news->featured_image) }}" alt="{{ $news->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-[1.04]">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-5xl font-black text-white/25"
                                    style="background:linear-gradient(135deg,#15803d,#22c55e)">
                                    {{ strtoupper(substr($news->title, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex flex-col flex-1 p-5">
                            <span
                                class="text-[10.5px] font-bold text-[#15803d] bg-[#15803d]/[.08] px-2.5 py-1 rounded-md w-fit mb-3">
                                {{ $news->published_at?->format('d M Y') ?? 'Terbaru' }}
                            </span>
                            <h3 class="text-[15px] font-bold text-gray-900 leading-snug mb-2.5 line-clamp-2">
                                {{ $news->title }}</h3>
                            <p class="text-[13.5px] text-gray-400 leading-relaxed flex-1 mb-4 line-clamp-3">
                                {{ $news->excerpt ?? Str::limit(strip_tags($news->content), 100) }}
                            </p>
                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ route('news.detail', $news->slug) }}"
                                    class="inline-flex items-center gap-1.5 text-[13px] font-bold text-[#15803d] transition-all hover:gap-3">
                                    Baca Selengkapnya <i class="text-xs fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="py-10 text-center text-gray-400 col-span-full">Belum ada berita terbaru</div>
                @endforelse
            </div>
        </div>
    </section>


    {{-- ═══════════ PRESTASI ═══════════ --}}
    <section class="py-20 bg-[#F0F4ED]">
        <div class="max-w-screen-xl px-6 mx-auto">
            <div class="max-w-xl mx-auto text-center mb-14">
                <span class="text-[11px] font-extrabold uppercase tracking-[.18em] text-[#15803d]">Pencapaian
                    Sekolah</span>
                <h2 class="mt-3 text-[2rem] lg:text-[2.2rem] font-extrabold text-[#14532d] tracking-tight">
                    Prestasi Terbaru {{ config('app.name') }}
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @if ($prestasis->isEmpty())
                    <div class="py-10 text-center text-gray-400 col-span-full">Belum ada prestasi yang dipublikasikan
                    </div>
                @else
                    @foreach ($prestasis as $prestasi)
                        @php $award = getAwardIcon($prestasi->category); @endphp
                        <div class="flex flex-col h-full overflow-hidden transition-all bg-white border border-gray-100 rounded-2xl hover:-translate-y-1 hover:shadow-lg"
                            style="box-shadow:0 1px 8px rgba(0,0,0,.05)">
                            <div class="flex items-center justify-center flex-shrink-0 px-6 py-8 bg-gray-50">
                                <div class="w-[72px] h-[72px] rounded-2xl flex items-center justify-center transition-transform hover:scale-110"
                                    style="{{ $award['bgStyle'] }};box-shadow:0 6px 18px rgba(0,0,0,.11)">
                                    <i class="{{ $award['icon'] }} text-white text-3xl"></i>
                                </div>
                            </div>
                            <div class="flex flex-col flex-1 p-5">
                                <h3 class="text-[15px] font-bold text-gray-900 leading-snug mb-1.5 line-clamp-2">
                                    {{ $prestasi->title }}</h3>
                                @if ($prestasi->category)
                                    <div class="text-[10.5px] font-extrabold uppercase tracking-wide mb-2"
                                        style="{{ $award['textStyle'] }}">
                                        {{ $prestasi->category }}
                                    </div>
                                @endif
                                <p class="text-[13.5px] text-gray-400 leading-relaxed flex-1 mb-3 line-clamp-2">
                                    {{ Str::limit(strip_tags($prestasi->description), 120) }}</p>
                                @if ($prestasi->achievement_date)
                                    <div class="flex items-center gap-1.5 text-xs text-gray-400 mb-4">
                                        <i class="fas fa-calendar-alt text-[10px]"></i>
                                        {{ $prestasi->achievement_date->format('d M Y') }}
                                    </div>
                                @endif
                                <div class="pt-4 mt-auto border-t border-gray-100">
                                    <a href="{{ route('prestasi.detail', $prestasi->slug) }}"
                                        class="inline-flex items-center gap-1.5 text-[13px] font-bold transition-all hover:gap-3"
                                        style="{{ $award['textStyle'] }}">
                                        Baca Selengkapnya <i class="text-xs fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            @if ($prestasis->isNotEmpty())
                <div class="mt-10 text-center">
                    <a href="{{ route('prestasi.index') }}"
                        class="inline-flex items-center gap-2 px-8 py-3 text-sm font-bold text-white rounded-xl transition-all hover:-translate-y-0.5"
                        style="background:#15803d;box-shadow:0 4px 16px rgba(21,128,61,.28)">
                        Lihat Semua Prestasi <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>


    {{-- ═══════════ KONSULTASI ═══════════ --}}
    {{--
        KONSEP (dipertahankan & disempurnakan):
        Kiri = marketing copy + trust signals
        Kanan = preview card dekoratif (skeleton) — bukan form aktif
        Semua CTA → /konsultasi (halaman form penuh)
        Pola ini benar: "teaser di home, aksi di halaman dedicated"
        Badge "Dijawab Tim" dipindah ke DALAM card supaya tidak terpotong
    --}}
    <section id="konsultasi" class="relative py-20 overflow-hidden bg-white border-t border-[#e8f5e9]">

        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-32 -right-32 w-[480px] h-[480px] rounded-full"
                style="background:radial-gradient(circle,rgba(21,128,61,.06) 0%,transparent 65%)"></div>
            <div class="absolute rounded-full -bottom-24 -left-24 w-80 h-80"
                style="background:radial-gradient(circle,rgba(234,179,8,.05) 0%,transparent 65%)"></div>
        </div>

        <div class="relative z-10 max-w-screen-xl px-6 mx-auto">
            <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2 lg:gap-16">

                {{-- LEFT — Info & Trust --}}
                <div class="flex flex-col gap-6">
                    <div>
                        <span class="text-[11px] font-extrabold uppercase tracking-[.18em] text-[#15803d]">Tanya
                            Kami</span>
                        <h2
                            class="mt-3 text-[2rem] lg:text-[2.2rem] font-extrabold text-[#14532d] leading-snug tracking-tight">
                            Ada Pertanyaan<br>Seputar Sekolah?
                        </h2>
                        <p class="mt-4 text-[15px] text-gray-500 leading-relaxed">
                            Kirimkan pertanyaan Anda tentang PPDB, kurikulum, fasilitas, atau hal lain seputar
                            {{ config('app.name') }}. Kami akan menjawab langsung ke email Anda dalam 1–2 hari kerja.
                        </p>
                    </div>

                    <div class="flex flex-col gap-3">
                        @foreach ([['fas fa-bolt', 'Respons Cepat', 'Jawaban dikirim dalam 1–2 hari kerja'], ['fas fa-envelope-open-text', 'Langsung ke Email', 'Jawaban dikirim ke inbox Anda'], ['fas fa-shield-alt', 'Privasi Terjaga', 'Data Anda aman dan tidak disebarkan']] as [$icon, $title, $desc])
                            <div
                                class="flex items-start gap-4 p-4 rounded-2xl bg-[#f8fdf9] border border-[#15803d]/10">
                                <div class="flex items-center justify-center flex-shrink-0 w-9 h-9 rounded-xl"
                                    style="background:#15803d;box-shadow:0 4px 12px rgba(21,128,61,.28)">
                                    <i class="{{ $icon }} text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-[#14532d]">{{ $title }}</p>
                                    <p class="text-[13px] text-gray-400 mt-0.5">{{ $desc }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- CTA --}}
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('konsultasi') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold text-white rounded-xl transition-all hover:-translate-y-0.5 active:scale-[.98]"
                            style="background:#15803d;box-shadow:0 4px 16px rgba(21,128,61,.3)">
                            <i class="text-xs fas fa-comments"></i>
                            Mulai Konsultasi
                        </a>
                        {{-- ✅ FIX: "Lihat FAQ" → /konsultasi#faq (bukan /konsultasi saja) --}}
                        <a href="{{ route('konsultasi') }}#faq"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 text-sm font-bold rounded-xl border transition-all hover:-translate-y-0.5 active:scale-[.98] bg-white"
                            style="color:#15803d;border-color:rgba(21,128,61,.2)">
                            <i class="text-xs fas fa-question-circle"></i>
                            Lihat FAQ
                        </a>
                    </div>
                </div>

                {{-- RIGHT — Preview card dekoratif (skeleton, tidak interaktif) --}}
                <div class="relative">
                    <div class="hidden lg:block absolute rounded-[28px] border-2 border-dashed border-[#15803d]/14"
                        style="inset:-14px;transform:rotate(-1.5deg)"></div>

                    <div class="relative bg-white rounded-[22px] border border-[#15803d]/10 overflow-hidden"
                        style="box-shadow:0 12px 40px rgba(21,128,61,.10)">

                        {{-- Header card --}}
                        <div class="py-5 px-7" style="background:linear-gradient(90deg,#15803d,#22c55e)">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white/20">
                                    <i class="text-base text-white fas fa-comments"></i>
                                </div>
                                <div>
                                    <p class="text-white font-extrabold text-[15px] leading-none">Formulir Konsultasi
                                    </p>
                                    <p class="text-[11px] text-green-100 mt-1">{{ config('app.name') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Preview skeleton (dekoratif) --}}
                        <div class="py-6 space-y-4 px-7">
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <p class="text-[11px] font-semibold text-gray-400 mb-1.5 uppercase tracking-wide">
                                        Nama</p>
                                    <div
                                        class="flex items-center px-3 border border-gray-100 h-9 rounded-xl bg-gray-50">
                                        <div class="h-2.5 w-24 rounded bg-gray-200"></div>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[11px] font-semibold text-gray-400 mb-1.5 uppercase tracking-wide">
                                        Email</p>
                                    <div
                                        class="flex items-center px-3 border border-gray-100 h-9 rounded-xl bg-gray-50">
                                        <div class="h-2.5 w-20 rounded bg-gray-200"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold text-gray-400 mb-1.5 uppercase tracking-wide">Topik
                                </p>
                                <div class="flex items-center px-3 border border-gray-100 h-9 rounded-xl bg-gray-50">
                                    <div class="h-2.5 w-32 rounded bg-gray-200"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold text-gray-400 mb-1.5 uppercase tracking-wide">
                                    Pertanyaan</p>
                                <div class="h-24 p-3 space-y-2 border border-gray-100 rounded-xl bg-gray-50">
                                    <div class="w-full h-2 bg-gray-200 rounded"></div>
                                    <div class="w-5/6 h-2 bg-gray-200 rounded"></div>
                                    <div class="w-4/6 h-2 bg-gray-200 rounded"></div>
                                </div>
                            </div>

                            <a href="{{ route('konsultasi') }}"
                                class="flex items-center justify-center gap-2 w-full py-3 text-sm font-bold rounded-xl transition-all hover:-translate-y-0.5 active:scale-[.98]"
                                style="background:#EAB308;color:#14532d;box-shadow:0 4px 14px rgba(234,179,8,.35)">
                                <i class="text-xs fas fa-paper-plane"></i> Kirim Pertanyaan
                            </a>

                            {{-- ✅ FIX: Badge dipindah ke dalam card (tidak lagi floating -bottom-5 yang bisa terpotong) --}}
                            <div class="flex items-center justify-between pt-1">
                                <p class="text-[11px] text-gray-400">
                                    <i class="mr-1 fas fa-lock"></i> Data Anda aman & tidak disebarkan
                                </p>
                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full"
                                    style="background:rgba(21,128,61,.08)">
                                    <div class="flex items-center justify-center flex-shrink-0 w-4 h-4 rounded-full"
                                        style="background:#15803d">
                                        <i class="text-white fas fa-check" style="font-size:7px"></i>
                                    </div>
                                    <div>
                                        <p
                                            class="text-[8px] uppercase tracking-widest text-gray-400 font-bold leading-none">
                                            Dijawab Tim</p>
                                        <p class="text-[10px] font-extrabold text-[#15803d] leading-none mt-0.5">via
                                            Email</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
