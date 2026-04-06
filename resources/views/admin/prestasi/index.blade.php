@extends('admin.layout')

@section('page_title', 'Prestasi Siswa')
@section('page_subtitle', 'Kelola data prestasi peserta didik')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Prestasi</h3>
            <p class="text-sm text-gray-500">Total {{ $prestasis->total() }} prestasi</p>
        </div>
        <a href="{{ route('admin.prestasis.create') }}"
            class="flex items-center gap-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus"></i> Tambah Prestasi
        </a>
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Judul Prestasi</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($prestasis as $prestasi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($prestasi->featured_image)
                                        <img src="{{ url('/files/' . $prestasi->featured_image) }}"
                                            alt="{{ $prestasi->title }}" class="object-cover w-10 h-10 rounded-lg shrink-0"
                                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                        <div
                                            class="items-center justify-center hidden w-10 h-10 bg-yellow-100 rounded-lg shrink-0">
                                            <i class="text-yellow-500 fas fa-trophy"></i>
                                        </div>
                                    @else
                                        <div
                                            class="flex items-center justify-center w-10 h-10 bg-yellow-100 rounded-lg shrink-0">
                                            <i class="text-yellow-500 fas fa-trophy"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $prestasi->title }}</p>
                                        @if ($prestasi->description)
                                            <p class="mt-0.5 text-xs text-gray-400 line-clamp-1">
                                                {{ Str::limit(strip_tags($prestasi->description), 80) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $prestasi->category ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $prestasi->achievement_date ? $prestasi->achievement_date->format('d M Y') : '—' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($prestasi->status === 'published')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Tayang
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.prestasis.edit', $prestasi) }}"
                                        class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.prestasis.destroy', $prestasi) }}" method="POST"
                                        onsubmit="return confirm('Hapus prestasi \'{{ addslashes($prestasi->title) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
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
                                <i class="mb-3 text-4xl text-gray-300 fas fa-trophy"></i>
                                <p class="text-gray-500">Belum ada data prestasi.</p>
                                <a href="{{ route('admin.prestasis.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus"></i> Tambah Prestasi Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $prestasis->links() }}</div>

@endsection
