<div>
    {{-- ===== HERO HEADER ===== --}}
    <div class="pt-8 pb-8" style="background: linear-gradient(to right, #14532d, #15803d)">
        <div class="container px-6 mx-auto">
            <nav class="flex items-center mb-4 space-x-2 text-sm text-white">
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
                <span>/</span>
                <span>Guru & Staf</span>
            </nav>
            <h1 class="text-4xl font-bold text-white font-display">Tim Pendidik Kami</h1>
            <p class="mt-2" style="color: #bbf7d0">Guru-guru profesional yang berdedikasi memberikan pendidikan
                berkualitas</p>
        </div>
    </div>

    <section class="py-20" style="background: #F0F4ED">
        <div class="container px-6 mx-auto">

            {{-- ===== JUDUL SECTION ===== --}}
            <div class="max-w-3xl mx-auto mb-16 text-center">
                <span class="text-sm font-semibold tracking-wider uppercase" style="color: #15803d">Tim Profesional
                    Kami</span>
                <h2 class="mt-4 mb-6 text-4xl font-bold font-display" style="color: #14532d">Tenaga Pendidik & Pengajar
                    Berpengalaman</h2>
                <p class="leading-relaxed text-gray-600">
                    Guru-guru berpengalaman dan berdedikasi yang siap membimbing setiap siswa mencapai potensi maksimal
                    mereka.
                </p>
            </div>

            @php
                $principal = $teachers->firstWhere('is_principal', true);
                $others = $teachers->filter(fn($t) => !$t->is_principal);
            @endphp

            @if ($teachers->isEmpty())
                {{-- ===== EMPTY STATE ===== --}}
                <div class="p-12 text-center rounded-2xl"
                    style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                    <svg class="w-16 h-16 mx-auto mb-4" style="color: #15803d40" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 4.354a4 4 0 110 8.048M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z" />
                    </svg>
                    <p class="text-lg font-semibold text-gray-600">Belum ada data guru yang ditambahkan</p>
                    <p class="mt-2 text-sm text-gray-500">Data guru sedang dalam proses pembaruan</p>
                </div>
            @else

                {{-- ===== KEPALA SEKOLAH — no background, transparan ===== --}}
                @if ($principal)
                    <div class="flex justify-center mb-14">
                        <div class="text-center transition-all duration-300 hover:-translate-y-1" style="width: 200px;">

                            {{-- Badge --}}
                            <div class="flex justify-center mb-4">
                                <span
                                    class="inline-flex items-center gap-1 px-3 py-0.5 text-xs font-bold tracking-widest uppercase rounded-full"
                                    style="background: #dcfce7; color: #15803d; border: 1px solid #86efac">
                                    Kepala Sekolah
                                </span>
                            </div>

                            {{-- Foto --}}
                            <div class="flex justify-center">
                                <div class="overflow-hidden rounded-full shadow-md w-28 h-28"
                                    style="border: 3px solid #15803d;">
                                    @if ($principal->featured_image)
                                        <img src="{{ url('/files/' . $principal->featured_image) }}"
                                            alt="{{ $principal->name }}" class="object-cover w-full h-full">
                                    @else
                                        <div class="flex items-center justify-center w-full h-full text-3xl font-bold"
                                            style="background: linear-gradient(to bottom right, #f0fdf4, #dcfce7); color: #15803d">
                                            {{ strtoupper(substr($principal->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Garis bawah foto --}}
                            <div class="w-36 h-0.5 mx-auto mt-4 mb-3 rounded-full" style="background: #15803d"></div>

                            {{-- Nama --}}
                            <h3 class="text-sm font-bold font-display" style="color: #14532d">
                                {{ $principal->name }}
                            </h3>

                            {{-- Jabatan --}}
                            <p class="mt-1 text-xs font-medium" style="color: #15803d">
                                {{ $principal->subject ?? 'Kepala Sekolah' }}
                            </p>

                        </div>
                    </div>

                    @if ($others->isNotEmpty())
                        <div class="flex items-center gap-4 mb-12">
                            <div class="flex-1 h-px" style="background: #d1fae5"></div>
                            <span class="text-lg font-semibold tracking-widest uppercase" style="color: #6b7280">
                                Guru & Staf
                            </span>
                            <div class="flex-1 h-px" style="background: #d1fae5"></div>
                        </div>
                        <div class="w-280 h-0.5 mx-auto mb-8 rounded-full" style="background: #15803d"></div>
                    @endif
                @endif

                {{-- ===== GRID GURU LAINNYA ===== --}}
                @if ($others->isNotEmpty())
                    <div class="grid gap-4 mb-12 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4" style="column-gap: 0px;">
                        @foreach ($others as $teacher)
                            <div class="text-center transition-all duration-300 group hover:-translate-y-1">

                                {{-- Foto --}}
                                <div class="relative flex items-center justify-center mx-auto overflow-hidden rounded-full shadow-md w-28 h-28"
                                    style="background: linear-gradient(to bottom right, #f0fdf4, #dcfce7)">
                                    @if ($teacher->featured_image)
                                        <img src="{{ url('/files/' . $teacher->featured_image) }}"
                                            alt="{{ $teacher->name }}" class="object-cover w-full h-full">
                                    @else
                                        <i class="text-4xl fas fa-chalkboard-user" style="color: #15803d"></i>
                                    @endif
                                </div>

                                {{-- Garis bawah foto --}}
                                <div class="w-32 h-0.5 mx-auto mt-4 mb-3 rounded-full" style="background: #15803d"></div>

                                {{-- Nama --}}
                                <h3 class="text-sm font-bold font-display" style="color: #14532d">
                                    {{ $teacher->name }}
                                </h3>

                                {{-- Jabatan --}}
                                <p class="mt-1 text-xs font-medium" style="color: #15803d">
                                    {{ $teacher->subject ?? '—' }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

            @endif

            {{-- ===== PAGINATION ===== --}}
            <div class="flex justify-center mt-12">
                {{ $teachers->links() }}
            </div>

        </div>
    </section>
</div>