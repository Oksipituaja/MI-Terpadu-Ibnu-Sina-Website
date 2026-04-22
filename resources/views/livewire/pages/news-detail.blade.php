<div class="min-h-screen" style="background: #F0F4ED">

    <style>
        .tinymce-render p {
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .tinymce-render strong {
            font-weight: 700;
        }

        .tinymce-render em {
            font-style: italic;
        }

        .tinymce-render u {
            text-decoration: underline;
        }

        .tinymce-render s {
            text-decoration: line-through;
        }

        .tinymce-render ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin: 0.75rem 0 !important;
        }

        .tinymce-render ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin: 0.75rem 0 !important;
        }

        .tinymce-render li {
            margin-bottom: 0.5rem;
            line-height: 1.7;
        }

        .tinymce-render blockquote {
            border-left: 4px solid #15803d !important;
            padding: 12px 16px !important;
            margin: 16px 0 !important;
            background: #f0fdf4 !important;
            color: #166534 !important;
            font-style: italic;
            border-radius: 0 8px 8px 0;
            display: block !important;
        }

        .tinymce-render a {
            color: #15803d;
            text-decoration: underline;
        }

        .tinymce-render h1 {
            font-size: 1.875rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render h4 {
            font-size: 1.125rem;
            font-weight: 700;
            color: #14532d;
            margin: 1.5rem 0 0.75rem;
        }

        .tinymce-render [style*="text-align: center"] {
            text-align: center !important;
        }

        .tinymce-render [style*="text-align: right"] {
            text-align: right !important;
        }

        .tinymce-render [style*="text-align: justify"] {
            text-align: justify !important;
        }
    </style>

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

        <div class="leading-relaxed text-gray-800 tinymce-render max-w-none">
            {!! $news->content !!}
        </div>

        <div class="pt-8 mt-12 border-t" style="border-color: #15803d26">
            <a href="{{ route('news') }}" class="font-semibold transition-colors hover:opacity-80"
                style="color: #15803d">
                <i class="mr-1 fas fa-arrow-left"></i> Kembali ke Berita
            </a>
        </div>
    </div>
</div>
