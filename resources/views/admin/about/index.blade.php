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
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Judul</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Tipe Konten</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Pratinjau</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($abouts as $about)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $about->title }}</td>
                            <td class="px-6 py-4">
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
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $k['class'] }}">
                                    {{ $k['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($about->featured_image)
                                    <img src="{{ asset('storage/' . $about->featured_image) }}"
                                        onerror="this.onerror=null;this.src='/files/{{ $about->featured_image }}'"
                                        alt="{{ $about->title }}" class="object-cover w-12 h-12 rounded-lg">
                                @elseif ($about->key === 'school_info')
                                    @php $info = json_decode($about->content, true) ?: []; @endphp
                                    <span class="text-xs text-gray-500">
                                        {{ $info['nama_sekolah'] ?? '—' }} · NPSN: {{ $info['npsn'] ?? '—' }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500">
                                        {{ Str::limit(strip_tags($about->content), 60) ?: '—' }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.about.edit', $about) }}"
                                        class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.about.destroy', $about) }}" method="POST"
                                        onsubmit="return confirm('Hapus konten \'{{ addslashes($about->title) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center gap-1 text-sm text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i> Hapus
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
