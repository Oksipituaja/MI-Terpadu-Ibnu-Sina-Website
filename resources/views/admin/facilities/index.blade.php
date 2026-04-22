@extends('admin.layout')

@section('page_title', 'Fasilitas Sekolah')
@section('page_subtitle', 'Kelola informasi fasilitas sekolah')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Fasilitas</h3>
            <p class="text-sm text-gray-500">Total {{ $facilities->total() }} fasilitas</p>
        </div>
        <a href="{{ route('admin.facilities.create') }}"
            class="flex items-center gap-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus"></i> Tambah Fasilitas
        </a>
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Nama Fasilitas</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Ikon</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Kondisi</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Deskripsi</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($facilities as $facility)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $facility->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($facility->icon)
                                    <div class="flex items-center gap-2">
                                        <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-lg">
                                            <i class="{{ $facility->icon }} text-blue-600"></i>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $facility->icon }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $kondisiMap = [
                                        'tersedia' => ['label' => 'Tersedia', 'class' => 'bg-green-100 text-green-700'],
                                        'perbaikan' => [
                                            'label' => 'Perbaikan',
                                            'class' => 'bg-yellow-100 text-yellow-700',
                                        ],
                                        'belum_ada' => ['label' => 'Belum Ada', 'class' => 'bg-red-100 text-red-700'],
                                        'akan_ada' => ['label' => 'Akan Ada', 'class' => 'bg-blue-100 text-blue-700'],
                                    ];
                                    $k = $kondisiMap[$facility->kondisi] ?? [
                                        'label' => '—',
                                        'class' => 'bg-gray-100 text-gray-600',
                                    ];
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $k['class'] }}">
                                    {{ $k['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ Str::limit(strip_tags($facility->description ?? ''), 60) ?: '—' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.facilities.edit', $facility) }}"
                                        class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST"
                                        onsubmit="return confirm('Hapus fasilitas \'{{ addslashes($facility->name) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
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
                            <td colspan="5" class="px-6 py-16 text-center">
                                <i class="mb-3 text-4xl text-gray-300 fas fa-building"></i>
                                <p class="text-gray-500">Belum ada data fasilitas.</p>
                                <a href="{{ route('admin.facilities.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus"></i> Tambah Fasilitas Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $facilities->links() }}</div>

@endsection
