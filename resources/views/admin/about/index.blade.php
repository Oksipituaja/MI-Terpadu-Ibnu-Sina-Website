@extends('admin.layout')

@section('page_title', 'Tentang Sekolah')
@section('page_subtitle', 'Kelola informasi dan konten tentang sekolah')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Konten Tentang Sekolah</h3>
            <p class="text-sm text-gray-500">Total {{ $abouts->count() }} konten</p>
        </div>
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="w-1/4 px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Judul</th>
                        <th class="w-1/6 px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Tipe Konten</th>
                        <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase">
                            Pratinjau</th>
                        <th class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase w-28">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($abouts as $about)
                        <tr class="transition-colors duration-150 hover:bg-gray-50">

                            {{-- JUDUL --}}
                            <td class="px-6 py-4 text-sm font-semibold text-gray-900 align-middle">
                                {{ $about->title }}
                            </td>

                            {{-- TIPE KONTEN --}}
                            <td class="px-6 py-4 align-middle">
                                @php
                                    $keyMap = [
                                        'home_hero_image' => [
                                            'label' => 'Hero Beranda',
                                            'class' => 'bg-orange-100 text-orange-700',
                                        ],
                                        'hero_image' => [
                                            'label' => 'Hero Tentang Kami',
                                            'class' => 'bg-indigo-100 text-indigo-700',
                                        ],
                                        'principal_greeting' => [
                                            'label' => 'Sambutan Kepsek',
                                            'class' => 'bg-green-100 text-green-700',
                                        ],
                                        'school_profile' => [
                                            'label' => 'Profil Sekolah',
                                            'class' => 'bg-blue-100 text-blue-700',
                                        ],
                                        'school_info' => [
                                            'label' => 'Informasi Sekolah',
                                            'class' => 'bg-yellow-100 text-yellow-700',
                                        ],
                                        'vision' => ['label' => 'Visi', 'class' => 'bg-purple-100 text-purple-700'],
                                        'mission' => ['label' => 'Misi', 'class' => 'bg-pink-100 text-pink-700'],
                                    ];
                                    $k = $keyMap[$about->key] ?? [
                                        'label' => $about->key,
                                        'class' => 'bg-gray-100 text-gray-600',
                                    ];
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $k['class'] }}">
                                    {{ $k['label'] }}
                                </span>
                            </td>

                            {{-- PRATINJAU --}}
                            <td class="px-6 py-4 align-middle">
                                @if ($about->featured_image)
                                    {{-- Konten dengan gambar --}}
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('storage/' . $about->featured_image) }}"
                                            onerror="this.onerror=null;this.src='/files/{{ $about->featured_image }}'"
                                            alt="{{ $about->title }}"
                                            class="flex-shrink-0 object-cover w-12 h-12 border border-gray-200 rounded-lg">
                                        @if ($about->content)
                                            @php
                                                // Bersihkan HTML entities dan tag sekaligus
                                                $preview = html_entity_decode(
                                                    strip_tags($about->content),
                                                    ENT_QUOTES | ENT_HTML5,
                                                    'UTF-8',
                                                );
                                                $preview = preg_replace('/\s+/', ' ', trim($preview));
                                            @endphp
                                            <span class="text-xs leading-relaxed text-gray-500 line-clamp-2">
                                                {{ Str::limit($preview, 80) }}
                                            </span>
                                        @endif
                                    </div>
                                @elseif ($about->key === 'school_info')
                                    {{-- Konten JSON Informasi Sekolah --}}
                                    @php $info = json_decode($about->content, true) ?: []; @endphp
                                    <div class="flex flex-col gap-1">
                                        <span class="text-xs font-medium text-gray-700">
                                            {{ $info['nama_sekolah'] ?? '—' }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            NPSN: {{ $info['npsn'] ?? '—' }}
                                            @if (!empty($info['alamat']))
                                                &bull; {{ Str::limit($info['alamat'], 40) }}
                                            @endif
                                        </span>
                                    </div>
                                @else
                                    {{-- Konten teks biasa (visi, misi, profil, dll) --}}
                                    @php
                                        $preview = html_entity_decode(
                                            strip_tags($about->content ?? ''),
                                            ENT_QUOTES | ENT_HTML5,
                                            'UTF-8',
                                        );
                                        $preview = preg_replace('/\s+/', ' ', trim($preview));
                                    @endphp
                                    @if ($preview)
                                        <p class="max-w-md text-xs leading-relaxed text-gray-600 line-clamp-2">
                                            {{ Str::limit($preview, 120) }}
                                        </p>
                                    @else
                                        <span class="text-xs italic text-gray-400">— Belum ada konten —</span>
                                    @endif
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="px-6 py-4 align-middle">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.about.edit', $about) }}"
                                        class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 transition-colors hover:text-blue-800">
                                        <i class="text-xs fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.about.destroy', $about) }}" method="POST"
                                        onsubmit="return confirm('Hapus konten \'{{ addslashes($about->title) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 text-sm font-medium text-red-500 transition-colors hover:text-red-700">
                                            <i class="text-xs fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <i class="mb-3 text-4xl text-gray-300 fas fa-info-circle"></i>
                                <p class="text-gray-500">Belum ada konten tentang sekolah.</p>
                                <a href="{{ route('admin.about.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus"></i> Tambah Konten Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
