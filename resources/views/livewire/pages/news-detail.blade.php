<div class="min-h-screen" style="background: #F0F4ED">
    <div class="px-4 py-12 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('news') }}" class="inline-block mb-4 transition-colors hover:text-white"
                style="color: #86efac">
                <i class="mr-1 fas fa-arrow-left"></i> Kembali ke Berita
            </a>
            <h1 class="text-4xl font-bold">{{ $news->title }}</h1>
        </div>
    </div>

    <div class="max-w-4xl px-4 py-16 mx-auto">
        <div class="mb-6">
            <p class="text-sm text-gray-500">Dipublikasikan pada
                {{ \Carbon\Carbon::parse($news->published_at)->format('d M Y H:i') }}</p>
        </div>

        <div class="flex items-center justify-center mb-8 overflow-hidden rounded-lg h-96"
            style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
            @if ($news->featured_image)
                <img src="{{ url('/files/' . $news->featured_image) }}" alt="{{ $news->title }}"
                    class="object-cover w-full h-full">
            @else
                <div class="flex flex-col items-center justify-center w-full h-full p-4 text-white"
                    style="background: linear-gradient(to bottom right, #15803d99, #15803d)">
                    <span class="mb-2 text-6xl font-bold opacity-80">{{ strtoupper(substr($news->title, 0, 1)) }}</span>
                    <p class="max-w-xs text-sm text-center line-clamp-2">{{ substr($news->title, 0, 40) }}</p>
                </div>
            @endif
        </div>

        <div class="prose max-w-none">
            <div class="leading-relaxed text-gray-800">
                {!! $news->content !!}
            </div>
        </div>

        <div class="pt-8 mt-12 border-t" style="border-color: #15803d26">
            <a href="{{ route('news') }}" class="font-semibold transition-colors hover:opacity-80"
                style="color: #15803d">
                <i class="mr-1 fas fa-arrow-left"></i> Kembali ke Berita
            </a>
        </div>
    </div>
</div>
