<div class="min-h-screen" style="background: #F0F4ED">
    <div class="px-4 py-12 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="max-w-5xl mx-auto">
            <a href="{{ route('gallery') }}" class="inline-block mb-4 transition-colors hover:text-white"
                style="color: #86efac">← Kembali ke Galeri</a>
            <h1 class="text-4xl font-bold">{{ $gallery->title }}</h1>
            <p class="mt-2" style="color: #86efac">Kategori: <span
                    class="font-semibold text-white">{{ ucfirst($gallery->category) }}</span></p>
        </div>
    </div>
    <div class="max-w-5xl px-4 py-16 mx-auto">
        <div class="flex items-center justify-center mb-12 overflow-hidden rounded-lg h-96"
            style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
            @if ($gallery->featured_image)
                <img src="{{ url('/files/' . $gallery->featured_image) }}" alt="{{ $gallery->title }}"
                    class="object-cover w-full h-full">
            @else
                <i class="fas fa-images text-8xl opacity-20" style="color: #15803d"></i>
            @endif
        </div>
        <div class="p-6 mb-12 rounded-lg" style="background: #dcfce7">
            <h3 class="mb-4 text-lg font-bold" style="color: #14532d">Informasi Galeri</h3>
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="mb-1 text-sm text-gray-600">Judul</p>
                    <p class="font-semibold text-gray-900">{{ $gallery->title }}</p>
                </div>
                <div>
                    <p class="mb-1 text-sm text-gray-600">Kategori</p>
                    <p class="font-semibold" style="color: #15803d">{{ ucfirst($gallery->category) }}</p>
                </div>
            </div>
            @if ($gallery->description)
                <div class="pt-4 mt-4 border-t" style="border-color: #15803d26">
                    <p class="mb-2 text-sm text-gray-600">Deskripsi</p>
                    <div class="text-gray-900">{!! $gallery->description !!}</div>
                </div>
            @endif
        </div>
        @if ($relatedGalleries->count() > 0)
            <div class="pt-8 mt-16 border-t" style="border-color: #15803d26">
                <h3 class="mb-8 text-2xl font-bold" style="color: #14532d">Galeri Lainnya -
                    {{ ucfirst($gallery->category) }}</h3>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedGalleries as $related)
                        <a href="{{ route('gallery.detail', $related->slug) }}" class="group">
                            <div class="relative flex items-center justify-center h-48 overflow-hidden transition rounded-lg"
                                style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                                @if ($related->featured_image)
                                    <img src="{{ url('/files/' . $related->featured_image) }}"
                                        alt="{{ $related->title }}"
                                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <i class="text-4xl fas fa-images opacity-30" style="color: #15803d"></i>
                                @endif
                                <div
                                    class="absolute inset-0 flex items-center justify-center transition-colors duration-300 bg-black/0 group-hover:bg-black/40">
                                    <span
                                        class="px-4 text-sm font-semibold text-center text-white transition-opacity opacity-0 group-hover:opacity-100">{{ $related->title }}</span>
                                </div>
                            </div>
                            <h4 class="mt-3 font-bold text-gray-900 transition line-clamp-2">{{ $related->title }}
                            </h4>
                            <p class="mt-1 text-sm font-medium" style="color: #15803d">
                                {{ ucfirst($related->category) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="pt-8 mt-12 border-t" style="border-color: #15803d26">
            <a href="{{ route('gallery') }}" class="font-semibold transition-colors hover:opacity-80"
                style="color: #15803d">
                ← Kembali ke Galeri
            </a>
        </div>
    </div>
</div>
