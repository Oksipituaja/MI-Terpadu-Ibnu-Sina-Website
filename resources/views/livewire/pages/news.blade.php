<div style="background: #F0F4ED; min-height: 100vh">

    {{-- ── HEADER ──────────────────────────────────────────────────── --}}
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

    {{-- ── TAB: BERITA ─────────────────────────────────────────────── --}}
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
                                        <span class="text-5xl font-bold opacity-80">
                                            {{ strtoupper(substr($item->title, 0, 1)) }}
                                        </span>
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

    {{-- ── TAB: AGENDA ─────────────────────────────────────────────── --}}
    @if ($tab === 'agenda')
        <section class="py-12">
            <div class="container px-6 mx-auto">

                @php
                    $filterLabels = [
                        'all' => 'Semua',
                        'ongoing' => 'Berlangsung',
                        'upcoming' => 'Mendatang',
                        'completed' => 'Selesai',
                    ];
                    $activeLabel = $filterLabels[$filter] ?? 'Semua';
                @endphp

                {{-- ── Mobile & Tablet: dropdown accordion (< lg) ──── --}}
                <div class="block mb-8 lg:hidden" x-data="{ open: false }">
                    <div class="relative">

                        {{-- Trigger button --}}
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full px-5 py-3 font-semibold rounded-full"
                            style="background: #15803d; color: white">
                            <span class="flex items-center gap-2">
                                {{ $activeLabel }}
                                @if (($counts[$filter] ?? 0) > 0)
                                    <span class="px-2 py-0.5 text-xs font-bold rounded-full"
                                        style="background: rgba(255,255,255,0.25)">
                                        {{ $counts[$filter] }}
                                    </span>
                                @endif
                            </span>
                            <svg class="w-4 h-4 ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- Dropdown list --}}
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1"
                            class="absolute z-20 w-full mt-2 overflow-hidden shadow-lg rounded-xl"
                            style="background: white; border: 1px solid #dcfce7">

                            @foreach ($filterLabels as $val => $label)
                                <button wire:click="$set('filter', '{{ $val }}')" @click="open = false"
                                    class="flex items-center justify-between w-full px-5 py-3 font-semibold text-left transition {{ !$loop->first ? 'border-t' : '' }}"
                                    style="{{ $filter === $val ? 'background: #dcfce7; color: #15803d' : 'color: #374151' }}; border-color: #f0fdf4">
                                    <span>{{ $label }}</span>
                                    @if (($counts[$val] ?? 0) > 0)
                                        <span class="px-2 py-0.5 text-xs font-bold rounded-full"
                                            style="{{ $filter === $val ? 'background: #15803d; color: white' : 'background: #dcfce7; color: #15803d' }}">
                                            {{ $counts[$val] }}
                                        </span>
                                    @endif
                                </button>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- ── Desktop: pill tabs (lg ke atas) ────────────────── --}}
                <div class="flex-wrap hidden gap-2 mb-8 lg:flex">
                    @foreach ($filterLabels as $val => $label)
                        <button wire:click="$set('filter', '{{ $val }}')"
                            class="flex items-center gap-2 px-5 py-2 text-sm font-semibold transition-all rounded-full"
                            style="{{ $filter === $val
                                ? ($val === 'completed'
                                    ? 'background: #4b5563; color: white; box-shadow: 0 2px 8px #4b556333'
                                    : 'background: #15803d; color: white; box-shadow: 0 2px 8px #15803d33')
                                : ($val === 'completed'
                                    ? 'background: white; color: #4b5563; border: 1.5px solid #d1d5db'
                                    : 'background: white; color: #15803d; border: 1.5px solid #bbf7d0') }}">
                            {{ $label }}
                            @if (($counts[$val] ?? 0) > 0)
                                <span class="px-1.5 py-0.5 text-xs font-bold rounded-full"
                                    style="{{ $filter === $val
                                        ? 'background: rgba(255,255,255,0.25); color: white'
                                        : ($val === 'completed'
                                            ? 'background: #f3f4f6; color: #4b5563'
                                            : 'background: #dcfce7; color: #15803d') }}">
                                    {{ $counts[$val] }}
                                </span>
                            @endif
                        </button>
                    @endforeach
                </div>

                {{-- ── AGENDA LIST ───────────────────────────────────── --}}
                <div class="space-y-4" wire:loading.class="transition-opacity opacity-50">
                    @forelse($agendas as $agenda)
                        @php
                            $showTime = $agenda->formatted_time && $agenda->formatted_time !== '00:00';

                            $statusLabels = [
                                'upcoming' => 'Mendatang',
                                'ongoing' => 'Berlangsung',
                                'completed' => 'Selesai',
                            ];
                            $borderColors = [
                                'upcoming' => '#15803d',
                                'ongoing' => '#15803d',
                                'completed' => '#9ca3af',
                            ];
                            $badgeStyles = [
                                'upcoming' => 'background: #dcfce7; color: #15803d',
                                'ongoing' => 'background: #15803d; color: white',
                                'completed' => 'background: #f3f4f6; color: #6b7280',
                            ];
                            $dotColors = [
                                'upcoming' => '#15803d',
                                'ongoing' => '#86efac',
                                'completed' => '#9ca3af',
                            ];
                        @endphp

                        <div class="p-5 transition-shadow duration-300 bg-white border-l-4 shadow-sm rounded-xl hover:shadow-md"
                            style="border-color: {{ $borderColors[$agenda->status] ?? '#9ca3af' }}">
                            <div class="flex flex-col items-start justify-between gap-3 sm:flex-row sm:gap-4">
                                <div class="flex-1 min-w-0">
                                    <h3 class="mb-2 text-base font-bold leading-snug sm:text-lg"
                                        style="color: #14532d">
                                        {{ $agenda->title }}
                                    </h3>
                                    <div
                                        class="flex flex-wrap items-center mb-3 text-xs text-gray-500 gap-x-4 gap-y-1 sm:text-sm">
                                        <span class="flex items-center gap-1.5">
                                            <i class="fas fa-calendar" style="color: #15803d"></i>
                                            {{ $agenda->event_date->translatedFormat('d M Y') }}
                                        </span>
                                        @if ($showTime)
                                            <span class="flex items-center gap-1.5">
                                                <i class="fas fa-clock" style="color: #15803d"></i>
                                                {{ $agenda->formatted_time }} WIB
                                            </span>
                                        @endif
                                        @if ($agenda->location)
                                            <span class="flex items-center gap-1.5">
                                                <i class="text-red-400 fas fa-map-marker-alt"></i>
                                                {{ $agenda->location }}
                                            </span>
                                        @endif
                                    </div>
                                    @if ($agenda->description)
                                        <p class="text-xs leading-relaxed text-gray-500 sm:text-sm line-clamp-2">
                                            {{ Str::limit(strip_tags($agenda->description ?? ''), 200) }}
                                        </p>
                                    @endif
                                </div>

                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full shrink-0 whitespace-nowrap self-start sm:self-center"
                                    style="{{ $badgeStyles[$agenda->status] ?? 'background: #f3f4f6; color: #6b7280' }}">
                                    <span class="inline-block w-1.5 h-1.5 rounded-full"
                                        style="background: {{ $dotColors[$agenda->status] ?? '#9ca3af' }}"></span>
                                    {{ $statusLabels[$agenda->status] ?? ucfirst($agenda->status) }}
                                </span>
                            </div>
                        </div>

                    @empty
                        {{-- ── FALLBACK per kategori ─────────────────── --}}
                        @if ($filter === 'ongoing')
                            <div class="text-center py-14 rounded-xl"
                                style="background: #f0fdf4; border: 1.5px dashed #86efac">
                                <div class="flex items-center justify-center mx-auto mb-4 rounded-full w-14 h-14"
                                    style="background: #dcfce7">
                                    <i class="text-xl fas fa-calendar-day" style="color: #15803d"></i>
                                </div>
                                <p class="font-semibold text-gray-700">Tidak ada kegiatan hari ini</p>
                                <p class="px-6 mt-1 text-sm text-gray-400">Belum ada kegiatan yang dijadwalkan untuk
                                    hari ini.</p>
                                <button wire:click="$set('filter', 'upcoming')"
                                    class="inline-flex items-center gap-2 px-5 py-2 mt-5 text-sm font-semibold text-white transition rounded-full"
                                    style="background: #15803d">
                                    <i class="fas fa-clock"></i> Lihat Kegiatan Mendatang
                                </button>
                            </div>
                        @elseif ($filter === 'upcoming')
                            <div class="text-center py-14 rounded-xl"
                                style="background: #f0fdf4; border: 1.5px dashed #86efac">
                                <div class="flex items-center justify-center mx-auto mb-4 rounded-full w-14 h-14"
                                    style="background: #dcfce7">
                                    <i class="text-xl fas fa-calendar-plus" style="color: #15803d"></i>
                                </div>
                                <p class="font-semibold text-gray-700">Belum ada kegiatan mendatang</p>
                                <p class="px-6 mt-1 text-sm text-gray-400">Kegiatan baru akan segera ditambahkan.</p>
                                <button wire:click="$set('filter', 'all')"
                                    class="inline-flex items-center gap-2 px-5 py-2 mt-5 text-sm font-semibold text-white transition rounded-full"
                                    style="background: #15803d">
                                    <i class="fas fa-border-all"></i> Lihat Semua Kegiatan
                                </button>
                            </div>
                        @elseif ($filter === 'completed')
                            <div class="text-center py-14 rounded-xl"
                                style="background: #f9fafb; border: 1.5px dashed #d1d5db">
                                <div class="flex items-center justify-center mx-auto mb-4 rounded-full w-14 h-14"
                                    style="background: #f3f4f6">
                                    <i class="text-xl fas fa-calendar-check" style="color: #9ca3af"></i>
                                </div>
                                <p class="font-semibold text-gray-700">Belum ada kegiatan yang selesai</p>
                                <p class="px-6 mt-1 text-sm text-gray-400">Riwayat kegiatan akan muncul setelah tanggal
                                    pelaksanaan berlalu.</p>
                                <button wire:click="$set('filter', 'upcoming')"
                                    class="inline-flex items-center gap-2 px-5 py-2 mt-5 text-sm font-semibold transition rounded-full"
                                    style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db">
                                    <i class="fas fa-clock"></i> Lihat Kegiatan Mendatang
                                </button>
                            </div>
                        @else
                            <div class="text-center py-14 rounded-xl" style="background: #F0F4ED">
                                <div class="flex items-center justify-center mx-auto mb-4 rounded-full w-14 h-14"
                                    style="background: #dcfce7">
                                    <i class="text-xl fas fa-calendar-times" style="color: #15803d60"></i>
                                </div>
                                <p class="font-semibold text-gray-700">Belum ada agenda kegiatan</p>
                                <p class="mt-1 text-sm text-gray-400">Agenda kegiatan sekolah akan segera ditambahkan.
                                </p>
                            </div>
                        @endif
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $agendas->links() }}
                </div>

            </div>
        </section>
    @endif

</div>
