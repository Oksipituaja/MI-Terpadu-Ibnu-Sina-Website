<div>
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

            <div class="grid gap-8 mb-12 md:grid-cols-2 lg:grid-cols-3">
                @forelse($teachers as $teacher)
                    <div class="text-center teacher-card group">
                        <div class="flex items-center justify-center w-32 h-32 mx-auto mb-6 overflow-hidden transition-transform duration-300 rounded-full shadow-lg group-hover:scale-110"
                            style="background: linear-gradient(to bottom right, #15803d, #22c55e)">
                            @if ($teacher->featured_image)
                                <img src="{{ url('/files/' . $teacher->featured_image) }}" alt="{{ $teacher->name }}"
                                    class="object-cover w-full h-full">
                            @else
                                <i class="text-5xl text-white fas fa-chalkboard-user"></i>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 transition font-display" style="color: #14532d">
                            {{ $teacher->name }}</h3>
                        <p class="mb-3 text-lg font-semibold" style="color: #15803d">{{ $teacher->subject }}</p>
                    </div>
                @empty
                    <div class="p-12 text-center col-span-full rounded-2xl"
                        style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                        <svg class="w-16 h-16 mx-auto mb-4" style="color: #15803d40" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 8.048M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z">
                            </path>
                        </svg>
                        <p class="text-lg font-semibold text-gray-600">Belum ada data guru yang ditambahkan</p>
                        <p class="mt-2 text-sm text-gray-500">Data guru sedang dalam proses pembaruan</p>
                    </div>
                @endforelse
            </div>

            <div class="flex justify-center mt-12">
                {{ $teachers->links() }}
            </div>
        </div>
    </section>
</div>
