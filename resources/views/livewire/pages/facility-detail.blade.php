<div class="min-h-screen" style="background: #F0F4ED">
    <div class="px-4 py-12 text-white" style="background: linear-gradient(to right, #15803d, #166534)">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('facilities') }}" class="inline-block mb-4 transition-colors hover:text-white" style="color: #86efac">← Kembali ke Fasilitas</a>
            <h1 class="text-4xl font-bold">{{ $facility->name }}</h1>
        </div>
    </div>
    <div class="max-w-4xl px-4 py-16 mx-auto">
        <div class="flex items-center justify-center mb-8 overflow-hidden rounded-lg h-96"
            style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
            @if($facility->featured_image)
                <img src="{{ url('/files/' . $facility->featured_image) }}"
                    alt="{{ $facility->name }}"
                    class="object-cover w-full h-full">
            @else
                <i class="{{ $facility->icon ?? 'fas fa-building' }} text-8xl opacity-30" style="color: #15803d"></i>
            @endif
        </div>
        <div class="mb-12 prose max-w-none">
            <div class="text-lg leading-relaxed text-gray-800">
                {{-- FIXED: was nl2br($facility->description) which double-encodes TinyMCE HTML output --}}
                {!! $facility->description !!}
            </div>
        </div>
        <div class="p-6 mb-12 rounded-lg" style="background: #dcfce7">
            <h3 class="mb-4 text-lg font-bold" style="color: #14532d">Informasi Fasilitas</h3>
            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <p class="mb-1 text-sm text-gray-600">Nama Fasilitas</p>
                    <p class="font-semibold text-gray-900">{{ $facility->name }}</p>
                </div>
                <div>
                    <p class="mb-1 text-sm text-gray-600">Status</p>
                    @php
                        $kondisiMap = [
                            'tersedia'  => ['background: #dcfce7; color: #15803d',   'Tersedia'],
                            'perbaikan' => ['background: #fef9c3; color: #a16207',   'Perbaikan'],
                            'belum_ada' => ['background: #fee2e2; color: #b91c1c',   'Belum Ada'],
                            'akan_ada'  => ['background: #dbeafe; color: #1d4ed8',   'Akan Ada'],
                        ];
                        $k = $kondisiMap[$facility->kondisi] ?? ['background: #f3f4f6; color: #6b7280', '-'];
                    @endphp
                    <span class="inline-block px-4 py-2 text-sm font-semibold rounded-full" style="{{ $k[0] }}">
                        {{ $k[1] }}
                    </span>
                </div>
            </div>
        </div>
        @if($otherFacilities->count() > 0)
            <div class="pt-8 mt-16 border-t" style="border-color: #15803d26">
                <h3 class="mb-8 text-2xl font-bold" style="color: #14532d">Fasilitas Lainnya</h3>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($otherFacilities as $other)
                        <a href="{{ route('facility.detail', $other->slug) }}" class="group">
                            <div class="relative flex items-center justify-center h-48 overflow-hidden transition rounded-lg"
                                style="background: linear-gradient(to bottom right, #dcfce7, #F0F4ED)">
                                @if($other->featured_image)
                                    <img src="{{ url('/files/' . $other->featured_image) }}" alt="{{ $other->name }}"
                                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <i class="{{ $other->icon ?? 'fas fa-building' }} text-4xl opacity-40" style="color: #15803d"></i>
                                @endif
                            </div>
                            <h4 class="mt-3 font-bold text-gray-900 transition">{{ $other->name }}</h4>
                            <p class="mt-1 text-sm text-gray-600">{{ Str::limit(strip_tags($other->description), 80) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="pt-8 mt-12 border-t" style="border-color: #15803d26">
            <a href="{{ route('facilities') }}" class="font-semibold transition-colors hover:opacity-80" style="color: #15803d">
                ← Kembali ke Fasilitas
            </a>
        </div>
    </div>
</div>