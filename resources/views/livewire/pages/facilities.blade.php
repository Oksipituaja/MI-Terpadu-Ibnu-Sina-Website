<div>
    <div class="pt-8 pb-8 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="container px-6 mx-auto">
            <nav class="flex items-center mb-4 space-x-2 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Fasilitas</span>
            </nav>
            <h1 class="text-4xl font-bold text-white font-display">Fasilitas Unggulan</h1>
            <p class="mt-2" style="color: #bbf7d0">Prasarana modern dan lengkap untuk mendukung pembelajaran optimal</p>
        </div>
    </div>

    <section class="py-20" style="background: #F0F4ED">
        <div class="container px-6 mx-auto">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($facilities as $facility)
                    <a href="{{ route('facility.detail', $facility->slug) }}"
                        class="block overflow-hidden transition-all duration-300 shadow-md facility-card group rounded-2xl hover:shadow-xl"
                        style="border: 1px solid #15803d1a; background: #fefefe">
                        <div class="relative flex items-center justify-center h-56 overflow-hidden"
                            style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                            @if($facility->featured_image)
                                <img src="{{ url('/files/' . $facility->featured_image) }}"
                                    alt="{{ $facility->name }}"
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                            @else
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <div class="flex items-center justify-center w-20 h-20 transition rounded-full"
                                        style="background: #15803d1a">
                                        <i class="{{ $facility->icon ?? 'fas fa-building' }} text-4xl group-hover:scale-110 transition-transform duration-300"
                                            style="color: #15803d"></i>
                                    </div>
                                </div>
                            @endif
                            <div class="absolute inset-0 transition-colors duration-300 bg-black/0 group-hover:bg-black/20"></div>
                        </div>

                        <div class="p-6 transition" style="background: #fefefe">
                            <div class="flex items-center gap-3 mb-3">
                                @if($facility->icon)
                                    <span class="flex items-center justify-center w-8 h-8 rounded-lg shrink-0"
                                        style="background: #15803d1a">
                                        <i class="{{ $facility->icon }} text-sm" style="color: #15803d"></i>
                                    </span>
                                @endif
                                <h3 class="text-xl font-bold text-gray-900 transition font-display" style="color: #14532d">
                                    {{ $facility->name }}
                                </h3>
                            </div>

                            <p class="mb-4 text-sm leading-relaxed text-gray-600">
                                {{-- {{ Str::limit($facility->description, 120) }} --}}
                                {{ Str::limit(strip_tags($facility->description), 120) }}
                            </p>

                            @if($facility->kondisi)
                                @php
                                    $kondisiMap = [
                                        'tersedia'  => ['background: #dcfce7; color: #15803d', 'fas fa-check-circle', 'Tersedia'],
                                        'perbaikan' => ['background: #fef9c3; color: #a16207', 'fas fa-tools',        'Perbaikan'],
                                        'belum_ada' => ['background: #fee2e2; color: #b91c1c', 'fas fa-times-circle', 'Belum Ada'],
                                        'akan_ada'  => ['background: #dbeafe; color: #1d4ed8', 'fas fa-clock',        'Akan Ada'],
                                    ];
                                    $k = $kondisiMap[$facility->kondisi] ?? ['background: #f3f4f6; color: #6b7280', 'fas fa-info-circle', $facility->kondisi];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-4"
                                    style="{{ $k[0] }}">
                                    <i class="{{ $k[1] }}"></i> {{ $k[2] }}
                                </span>
                            @endif

                            <div class="flex items-center text-sm font-semibold transition-transform group-hover:translate-x-1"
                                style="color: #15803d">
                                Lihat Detail
                                <i class="ml-2 fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-12 text-center col-span-full rounded-2xl" style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                        <i class="mb-4 text-5xl fas fa-building" style="color: #15803d40"></i>
                        <p class="text-lg font-semibold text-gray-600">Belum ada fasilitas yang ditambahkan</p>
                        <p class="mt-2 text-sm text-gray-500">Data fasilitas sedang dalam proses pembaruan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-20 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="container px-6 mx-auto text-center">
            <h2 class="mb-6 text-4xl font-bold font-display">Kunjungi Sekolah Kami</h2>
            <p class="max-w-2xl mx-auto mb-8 text-xl opacity-90">
                Lihat langsung semua fasilitas modern kami dan bagaimana kami menciptakan lingkungan belajar yang inspiratif.
            </p>
            <a href="https://wa.me/628123456789"
                class="inline-block px-8 py-4 font-bold transition-all shadow-lg rounded-xl hover:-translate-y-1"
                style="background: #EAB308; color: #14532d;">
                Hubungi Kami
                <span class="ml-2">→</span>
            </a>
        </div>
    </section>
</div>