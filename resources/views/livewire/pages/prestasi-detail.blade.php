<div style="background: #F0F4ED; min-height: 100vh">

    <div class="py-12 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="container px-6 mx-auto">
            <a href="{{ route('prestasi.index') }}"
                class="inline-flex items-center mb-4 text-sm transition-colors hover:text-white" style="color: #86efac">
                <i class="mr-2 fas fa-arrow-left"></i> Kembali ke Prestasi
            </a>
            <h1 class="text-4xl font-bold text-white">{{ $prestasi->title }}</h1>
            <div class="flex flex-wrap gap-4 mt-4">
                @if ($prestasi->category)
                    <span class="px-3 py-1 text-sm font-semibold rounded-full"
                        style="background: rgba(255,255,255,0.2); color: white">
                        {{ $prestasi->category }}
                    </span>
                @endif
                @if ($prestasi->achievement_date)
                    <span class="flex items-center gap-2 text-sm" style="color: #86efac">
                        <i class="fas fa-calendar"></i>
                        {{ $prestasi->achievement_date->format('d F Y') }}
                    </span>
                @endif
            </div>
        </div>
    </div>

    <div class="container px-6 py-12 mx-auto">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

            <div class="lg:col-span-2">
                @if ($prestasi->featured_image)
                    <div class="w-full mb-8 overflow-hidden shadow-lg rounded-xl">
                        <img src="{{ url('/files/' . $prestasi->featured_image) }}" alt="{{ $prestasi->title }}"
                            class="object-cover w-full h-auto">
                    </div>
                @else
                    @php $award = getAwardIcon($prestasi->category ?? ''); @endphp
                    <div class="flex items-center justify-center w-full h-64 mb-8 rounded-xl"
                        style="{{ $award['bgStyle'] }}">
                        <i class="{{ $award['icon'] }} text-white text-8xl opacity-40"></i>
                    </div>
                @endif

                <div class="prose prose-lg max-w-none">
                    <h2 class="mb-4 text-2xl font-bold" style="color: #14532d">Deskripsi</h2>
                    <div class="leading-relaxed text-gray-700 tinymce-content">
                        {!! $prestasi->description !!}
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky p-6 rounded-xl top-4" style="background: #dcfce7">
                    <h3 class="mb-6 text-lg font-bold" style="color: #14532d">Informasi Prestasi</h3>

                    @if ($prestasi->category)
                        @php $award = getAwardIcon($prestasi->category); @endphp
                        <div class="mb-6">
                            <p class="mb-2 text-sm font-semibold text-gray-600">Kategori</p>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full shrink-0"
                                    style="{{ $award['bgStyle'] }}">
                                    <i class="{{ $award['icon'] }} text-white text-sm"></i>
                                </div>
                                <span class="font-semibold" style="{{ $award['textStyle'] }}">
                                    {{ $prestasi->category }}
                                </span>
                            </div>
                        </div>
                    @endif

                    @if ($prestasi->achievement_date)
                        <div class="mb-6">
                            <p class="mb-2 text-sm font-semibold text-gray-600">Tanggal Pencapaian</p>
                            <p class="font-medium text-gray-900">{{ $prestasi->achievement_date->format('d F Y') }}</p>
                        </div>
                    @endif

                    <a href="{{ route('prestasi.index') }}"
                        class="inline-flex items-center justify-center w-full gap-2 px-4 py-2.5 font-semibold text-white transition-all rounded-xl hover:-translate-y-0.5"
                        style="background: #15803d; box-shadow: 0 4px 12px #15803d33">
                        <i class="fas fa-list"></i> Lihat Semua Prestasi
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>