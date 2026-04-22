<div style="background: #F0F4ED; min-height: 100vh">

    <div class="text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="container px-6 py-12 mx-auto">
            <nav class="flex items-center mb-4 space-x-2 text-sm" style="color: #86efac">
                <a href="{{ route('home') }}" class="transition-colors hover:text-white">Home</a>
                <span>/</span>
                <span class="text-white">Informasi</span>
            </nav>
            <h1 class="text-4xl font-bold text-white font-display">Berita & Agenda Sekolah</h1>
            <p class="mt-2" style="color: #bbf7d0">Informasi terkini, pengumuman, dan jadwal kegiatan sekolah</p>

            <div class="flex gap-3 mt-8">
                <button wire:click="setTab('berita')"
                    class="px-6 py-2.5 text-sm font-bold rounded-xl transition-all duration-200"
                    style="{{ $tab === 'berita'
                        ? 'background: #EAB308; color: #14532d; box-shadow: 0 4px 12px #EAB30844'
                        : 'background: rgba(255,255,255,0.15); color: white; border: 1.5px solid rgba(255,255,255,0.3)' }}">
                    <i class="mr-2 fas fa-newspaper"></i> Berita & Pengumuman
                </button>
                <button wire:click="setTab('agenda')"
                    class="px-6 py-2.5 text-sm font-bold rounded-xl transition-all duration-200"
                    style="{{ $tab === 'agenda'
                        ? 'background: #EAB308; color: #14532d; box-shadow: 0 4px 12px #EAB30844'
                        : 'background: rgba(255,255,255,0.15); color: white; border: 1.5px solid rgba(255,255,255,0.3)' }}">
                    <i class="mr-2 fas fa-calendar-alt"></i> Agenda Kegiatan
                </button>
            </div>
        </div>
    </div>

    @if ($tab === 'berita')
        <section class="py-12">
            <div class="container px-6 mx-auto">

                <div class="max-w-xl mb-10">
                    <div class="relative">
                        <i class="absolute text-sm -translate-y-1/2 fas fa-search left-4 top-1/2"
                            style="color: #15803d80"></i>
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Cari berita atau pengumuman..."
                            class="w-full py-3 pr-5 text-sm transition bg-white border-2 pl-11 rounded-xl focus:outline-none"
                            style="border-color: #15803d26;">
                    </div>
                </div>

                <div class="grid gap-6 mb-10 md:grid-cols-2 lg:grid-cols-3"
                    wire:loading.class="transition-opacity opacity-50">
                    @forelse($news as $item)
                        <div class="flex flex-col h-full overflow-hidden transition-all duration-300 bg-white border shadow-md rounded-xl hover:shadow-xl group"
                            style="border-color: #15803d1a">

                            <div class="relative flex items-center justify-center h-48 overflow-hidden"
                                style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                                @if ($item->featured_image)
                                    <img src="{{ url('/files/' . $item->featured_image) }}" alt="{{ $item->title }}"
                                        loading="lazy"
                                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <div class="flex flex-col items-center justify-center w-full h-full text-white"
                                        style="background: linear-gradient(to bottom right, #15803d99, #15803d)">
                                        <span
                                            class="text-5xl font-bold opacity-80">{{ strtoupper(substr($item->title, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-col flex-1 p-5">
                                <span class="px-3 py-1 mb-3 text-xs font-semibold rounded-full w-fit"
                                    style="color: #15803d; background: #dcfce7">
                                    {{ $item->published_at?->format('d M Y') ?? 'Terbaru' }}
                                </span>
                                <h3 class="mb-3 text-base font-bold leading-snug text-gray-900 line-clamp-2">
                                    {{ $item->title }}
                                </h3>
                                <p class="flex-1 mb-4 text-sm leading-relaxed text-gray-500 line-clamp-2">
                                    {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 90) }}
                                </p>
                                <div class="pt-3 border-t" style="border-color: #15803d1a"></div>
                                <a href="{{ route('news.detail', $item->slug) }}"
                                    class="inline-flex items-center mt-3 text-sm font-semibold transition-opacity group/link hover:opacity-75"
                                    style="color: #15803d">
                                    Baca Selengkapnya
                                    <i
                                        class="ml-2 transition-transform fas fa-arrow-right group-hover/link:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="py-16 text-center col-span-full rounded-2xl" style="background: #dcfce7">
                            <i class="mb-4 text-5xl fas fa-newspaper" style="color: #15803d40"></i>
                            <p class="font-semibold text-gray-600">Tidak ada berita yang ditemukan</p>
                            @if ($search)
                                <p class="mt-1 text-sm text-gray-400">Coba kata kunci lain</p>
                            @endif
                        </div>
                    @endforelse
                </div>

                <div class="flex justify-center">
                    {{ $news->links() }}
                </div>
            </div>
        </section>
    @endif

    @if ($tab === 'agenda')
        <section class="py-12">
            <div class="container px-6 mx-auto">

                <div class="flex flex-wrap gap-3 mb-8">
                    @foreach (['all' => 'Semua', 'upcoming' => 'Mendatang', 'completed' => 'Selesai'] as $val => $label)
                        <button wire:click="$set('filter', '{{ $val }}')"
                            class="px-5 py-2 text-sm font-semibold transition rounded-full"
                            style="{{ $filter === $val
                                ? ($val === 'completed'
                                    ? 'background: #6b7280; color: white'
                                    : 'background: #15803d; color: white; box-shadow: 0 2px 8px #15803d33')
                                : 'background: #dcfce7; color: #15803d' }}">
                            @if ($val === 'upcoming')
                                <i class="mr-1 fas fa-clock"></i>
                            @elseif($val === 'completed')
                                <i class="mr-1 fas fa-check"></i>
                            @endif
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

                <div class="space-y-4" wire:loading.class="transition-opacity opacity-50">
                    @forelse($agendas as $agenda)
                        @php $showTime = $agenda->formatted_time && $agenda->formatted_time !== '00:00'; @endphp
                        <div class="p-6 transition-shadow duration-300 bg-white border-l-4 shadow-sm rounded-xl hover:shadow-md"
                            style="border-color: {{ $agenda->status === 'upcoming' ? '#15803d' : '#9ca3af' }}">
                            <div class="flex flex-col items-start justify-between gap-4 sm:flex-row">
                                <div class="flex-1">
                                    <h3 class="mb-2 text-lg font-bold" style="color: #14532d">{{ $agenda->title }}</h3>
                                    <div class="flex flex-wrap items-center gap-4 mb-3 text-sm text-gray-500">
                                        <span class="flex items-center gap-1.5">
                                            <i class="fas fa-calendar" style="color: #15803d"></i>
                                            {{ $agenda->event_date->format('d M Y') }}
                                        </span>
                                        @if ($showTime)
                                            <span class="flex items-center gap-1.5">
                                                <i class="fas fa-clock" style="color: #15803d"></i>
                                                {{ $agenda->formatted_time }} WIB
                                            </span>
                                        @endif
                                        @if ($agenda->location)
                                            <span class="flex items-center gap-1.5">
                                                <i class="text-red-500 fas fa-map-marker-alt"></i>
                                                {{ $agenda->location }}
                                            </span>
                                        @endif
                                    </div>
                                    @if ($agenda->description)
                                        <p class="text-sm leading-relaxed text-gray-600">
                                            {{ Str::limit(strip_tags($agenda->description ?? ''), 200) }}
                                        </p>
                                    @endif
                                </div>
                                <span
                                    class="inline-block px-4 py-2 text-xs font-bold rounded-full shrink-0 whitespace-nowrap"
                                    style="{{ $agenda->status === 'upcoming' ? 'background: #dcfce7; color: #15803d' : 'background: #f3f4f6; color: #6b7280' }}">
                                    {{ $agenda->status === 'upcoming' ? 'Mendatang' : 'Selesai' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="py-16 text-center rounded-xl" style="background: #F0F4ED">
                            <i class="mb-4 text-4xl fas fa-calendar-times" style="color: #15803d40"></i>
                            <p class="font-medium text-gray-500">Tidak ada agenda untuk kategori ini</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $agendas->links() }}
                </div>
            </div>
        </section>
    @endif

</div>
