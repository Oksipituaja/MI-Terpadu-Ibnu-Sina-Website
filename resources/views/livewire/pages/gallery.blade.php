<div>
    <div class="pt-8 pb-8 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="container px-6 mx-auto">
            <nav class="flex items-center mb-4 space-x-2 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Galeri Sekolah</span>
            </nav>
            <h1 class="text-4xl font-bold text-white font-display">Galeri Sekolah</h1>
            <p class="mt-2" style="color: #bbf7d0">Koleksi dokumentasi aktivitas dan kegiatan sekolah</p>
        </div>
    </div>
    <section id="gallery" class="py-20" style="background: #F0F4ED">
        <div class="container px-6 mx-auto">
            {{-- Mobile & Tablet: dropdown --}}
            <div class="block mb-16 lg:hidden">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-5 py-3 font-semibold rounded-full"
                        style="background: #15803d; color: white">
                        <span>{{ $category ? ucfirst($category) : 'Semua Kategori' }}</span>
                        <svg class="w-4 h-4 ml-2 transition-transform" :class="{ 'rotate-180': open }" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition
                        class="absolute z-10 w-full mt-2 overflow-hidden shadow-lg rounded-xl"
                        style="background: white; border: 1px solid #dcfce7">
                        <button wire:click="$set('category', '')" @click="open = false"
                            class="block w-full px-5 py-3 font-semibold text-left transition"
                            style="{{ $category === '' ? 'background: #dcfce7; color: #15803d' : 'color: #374151' }}">
                            Semua
                        </button>
                        @foreach ($categories as $cat)
                            <button wire:click="$set('category', @js($cat))" @click="open = false"
                                class="block w-full px-5 py-3 font-semibold text-left transition border-t"
                                style="{{ $category === $cat ? 'background: #dcfce7; color: #15803d' : 'color: #374151' }}; border-color: #f0fdf4">
                                {{ ucfirst($cat) }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- Desktop: tabs --}}
            <div class="flex-wrap justify-center hidden gap-2 mb-16 lg:flex">
                <button wire:click="$set('category', '')"
                    class="px-5 py-2 text-sm font-semibold transition-all rounded-full"
                    style="{{ $category === '' ? 'background: #15803d; color: white' : 'background: #dcfce7; color: #15803d' }}">
                    Semua
                </button>
                @foreach ($categories as $cat)
                    <button wire:click="$set('category', @js($cat))"
                        class="px-5 py-2 text-sm font-semibold transition-all rounded-full"
                        style="{{ $category === $cat ? 'background: #15803d; color: white' : 'background: #dcfce7; color: #15803d' }}">
                        {{ ucfirst($cat) }}
                    </button>
                @endforeach
            </div>
            <div class="grid gap-6 mb-12 md:grid-cols-2 lg:grid-cols-3"
                wire:loading.class="transition-opacity opacity-50">
                @forelse($galleries as $item)
                    <a href="{{ route('gallery.detail', $item->slug) }}"
                        class="block cursor-pointer gallery-item group">
                        <div class="relative flex items-center justify-center h-64 overflow-hidden rounded-xl"
                            style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                            @if ($item->featured_image)
                                <img src="{{ url('/files/' . $item->featured_image) }}" alt="{{ $item->title }}"
                                    class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105"
                                    loading="lazy">
                            @else
                                <div class="flex flex-col items-center justify-center w-full h-full gap-2 transition"
                                    style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                                    <i class="text-5xl transition fas fa-images" style="color: #15803d40"></i>
                                    <span class="text-xs font-medium tracking-widest uppercase"
                                        style="color: #15803d80">Foto Segera Hadir</span>
                                </div>
                            @endif
                            <div
                                class="absolute inset-0 flex items-end justify-start p-4 transition-colors duration-300 bg-black/0 group-hover:bg-black/40">
                                <span
                                    class="text-sm font-semibold text-white transition-opacity opacity-0 group-hover:opacity-100 line-clamp-2">
                                    {{ $item->title }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h3 class="font-bold text-gray-900 transition line-clamp-1">{{ $item->title }}</h3>
                            <span class="inline-block mt-1 text-xs font-semibold px-2 py-0.5 rounded-full"
                                style="color: #15803d; background: #dcfce7">
                                {{ ucfirst($item->category) }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="p-12 text-center col-span-full rounded-xl"
                        style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                        <i class="mb-4 text-5xl fas fa-images" style="color: #15803d40"></i>
                        <p class="text-lg font-semibold text-gray-600">Tidak ada galeri untuk kategori ini</p>
                        <p class="mt-2 text-sm text-gray-500">Silakan pilih kategori lain</p>
                    </div>
                @endforelse
            </div>
            <div class="flex justify-center mt-8">
                {{ $galleries->links() }}
            </div>
        </div>
    </section>
    <section class="relative py-20 overflow-hidden text-white"
        style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 bg-white rounded-full w-96 h-96 blur-3xl"></div>
        </div>
        <div class="container relative z-10 px-6 mx-auto text-center">
            <h2 class="mb-6 text-4xl font-bold font-display">Tertarik Bergabung?</h2>
            <p class="max-w-2xl mx-auto mb-8 text-xl opacity-90">
                Jadilah bagian dari komunitas {{ config('app.name') }} dan rasakan pengalaman belajar yang luar biasa.
            </p>
            <a href="{{ route('ppdb') }}"
                class="inline-block px-8 py-4 font-bold transition-all shadow-lg rounded-xl hover:-translate-y-1"
                style="background: #EAB308; color: #14532d;">
                Daftar SPMB 2026/2027 <span class="ml-2">→</span>
            </a>
        </div>
    </section>
</div>
