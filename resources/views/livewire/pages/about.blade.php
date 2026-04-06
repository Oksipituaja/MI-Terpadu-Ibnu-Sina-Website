<div class="min-h-screen" style="background: #F0F4ED">
    @php
        $heroImagePath = $heroImage?->featured_image ? url('/files/' . $heroImage->featured_image) : null;
    @endphp

    @if ($heroImagePath)
        <div class="relative overflow-hidden h-96" style="background: linear-gradient(to bottom right, #15803d, #14532d)">
            <img src="{{ $heroImagePath }}" alt="{{ $heroImage->title ?? config('app.name') }}"
                class="object-cover w-full h-full">
            <div class="absolute inset-0" style="background: linear-gradient(to top, #14532d, transparent, transparent)">
            </div>
        </div>
    @else
        <div class="flex items-center justify-center h-96"
            style="background: linear-gradient(to bottom right, #15803d, #14532d)">
            <div class="text-center text-white">
                <i class="mb-4 text-6xl fas fa-school opacity-40"></i>
                <p class="text-xl font-medium opacity-60">Profil Sekolah</p>
            </div>
        </div>
    @endif

    <div class="max-w-6xl px-4 py-16 mx-auto">
        <h1 class="mb-12 text-4xl font-bold" style="color: #14532d">Tentang Kami</h1>

        {{-- Section Sambutan --}}
        @if ($principalGreeting)
            <div id="sambutan" class="relative py-16 my-12 overflow-hidden rounded-xl scroll-mt-32"
                style="background: linear-gradient(to bottom right, #F0F4ED, #dcfce7, #F0F4ED)">
                <div class="absolute inset-0 opacity-5">
                    <div class="absolute top-0 left-0 rounded-full w-96 h-96 blur-3xl" style="background: #15803d">
                    </div>
                    <div class="absolute bottom-0 right-0 rounded-full w-96 h-96 blur-3xl" style="background: #EAB308">
                    </div>
                </div>

                <div class="relative z-10 px-8">
                    <div class="mb-6 text-center">
                        <span class="text-sm font-semibold tracking-widest uppercase"
                            style="color: #15803d">Sambutan</span>
                    </div>

                    <h2 class="mb-12 text-3xl font-bold text-center md:text-4xl" style="color: #14532d">
                        {{ $principalGreeting->title ?? 'Sambutan Kepala Sekolah' }}
                    </h2>

                    <div class="grid items-center max-w-5xl gap-12 mx-auto lg:grid-cols-2">
                        <div class="order-2 space-y-6 lg:order-1">
                            <div class="text-base leading-relaxed text-gray-700">
                                {!! $principalGreeting->content !!}
                            </div>
                        </div>

                        <div class="flex justify-center order-1 lg:order-2">
                            <div class="relative w-64 h-64 md:w-80 md:h-80">
                                <div
                                    class="absolute inset-0 flex items-center justify-center overflow-hidden bg-white border-4 border-white rounded-full shadow-xl">
                                    @if ($principalGreeting->featured_image)
                                        <img src="{{ url('/files/' . $principalGreeting->featured_image) }}"
                                            alt="Kepala Sekolah" class="object-cover w-full h-full">
                                    @else
                                        <i class="text-gray-300 fas fa-user-tie text-8xl"></i>
                                    @endif
                                </div>

                                @if ($principalGreeting->principal_name)
                                    <div class="absolute z-20 px-6 py-2 text-white -translate-x-1/2 border-2 border-white rounded-full shadow-lg -bottom-2 left-1/2 whitespace-nowrap"
                                        style="background: #15803d">
                                        <p class="text-sm font-bold tracking-wide md:text-base">
                                            {{ $principalGreeting->principal_name }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Tombol Pelajari Lebih Lanjut --}}
        @if (!$expanded && $principalGreeting)
            <div class="my-12 text-center">
                <button wire:click="expand"
                    class="inline-flex items-center px-8 py-4 font-bold text-white transition-all rounded-lg shadow-lg hover:-translate-y-0.5"
                    style="background: #15803d; box-shadow: 0 4px 16px #15803d33;">
                    <i class="mr-3 fas fa-book"></i>
                    Pelajari Lebih Lanjut
                    <i class="ml-2 fas fa-chevron-down"></i>
                </button>
            </div>
        @endif

        {{-- Konten yang Di-Expand --}}
        @if ($expanded)
            {{-- Visi Misi --}}
            @if ($vision || $mission)
                <div id="visi-misi" class="grid gap-8 pt-12 my-16 border-t md:grid-cols-2 scroll-mt-32"
                    style="border-color: #15803d26">
                    @if ($vision)
                        <div class="p-8 shadow-sm rounded-2xl"
                            style="background: white; border-left: 8px solid #15803d">
                            <h3 class="mb-4 text-2xl font-bold" style="color: #14532d">{{ $vision->title }}</h3>
                            <div class="leading-relaxed prose-sm prose text-gray-700">{!! $vision->content !!}</div>
                        </div>
                    @endif

                    @if ($mission)
                        <div class="p-8 shadow-sm rounded-2xl"
                            style="background: white; border-left: 8px solid #EAB308">
                            <h3 class="mb-4 text-2xl font-bold" style="color: #854d0e">{{ $mission->title }}</h3>
                            <div class="leading-relaxed prose-sm prose text-gray-700">{!! $mission->content !!}</div>
                        </div>
                    @endif
                </div>
            @endif

            {{-- Looping Sections Lainnya --}}
            @forelse($aboutSections as $section)
                <div class="pt-12 mb-16 border-t scroll-mt-32" style="border-color: #15803d26">
                    <h2 class="mb-8 text-3xl font-bold" style="color: #14532d">{{ $section->title }}</h2>

                    @if ($section->featured_image)
                        <div class="mb-8 overflow-hidden shadow-lg rounded-2xl">
                            <img src="{{ url('/files/' . $section->featured_image) }}"
                                class="object-cover w-full max-h-96" alt="{{ $section->title }}">
                        </div>
                    @endif

                    @if ($section->key === 'school_info')
                        @php $info = json_decode($section->content, true) ?: []; @endphp
                        <div class="grid grid-cols-2 gap-6 p-6 bg-white shadow-sm rounded-2xl">
                            @foreach ($info as $key => $val)
                                <div>
                                    <span class="block mb-1 text-xs font-bold tracking-widest text-gray-400 uppercase">
                                        {{ str_replace('_', ' ', $key) }}
                                    </span>
                                    <p class="text-base font-semibold text-gray-800">{{ $val }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="leading-relaxed prose prose-lg text-gray-700 max-w-none">
                            {!! $section->content !!}
                        </div>
                    @endif
                </div>
            @empty
            @endforelse

            <div class="pt-12 my-12 text-center border-t" style="border-color: #15803d26">
                <a href="{{ route('about') }}"
                    class="inline-flex items-center px-8 py-3 font-semibold text-white transition-all rounded-lg"
                    style="background: #6b7280;">
                    <i class="mr-2 fas fa-chevron-up"></i>
                    Sembunyikan Detail
                </a>
            </div>
        @endif
    </div>
</div>
