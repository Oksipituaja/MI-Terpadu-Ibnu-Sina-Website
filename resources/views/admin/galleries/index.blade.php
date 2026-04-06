@extends('admin.layout')

@section('page_title', 'Galeri Foto')
@section('page_subtitle', 'Kelola foto dan album sekolah')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Galeri</h3>
            <p class="text-sm text-gray-500">Total {{ $galleries->total() }} item</p>
        </div>
        <a href="{{ route('admin.galleries.create') }}"
            class="flex items-center gap-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus"></i> Tambah Foto
        </a>
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Judul</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Deskripsi</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($galleries as $gallery)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($gallery->featured_image)
                                        <img src="{{ url('/files/' . $gallery->featured_image) }}"
                                            alt="{{ $gallery->title }}" class="object-cover w-10 h-10 rounded-lg shrink-0">
                                    @else
                                        <div
                                            class="flex items-center justify-center w-10 h-10 bg-purple-100 rounded-lg shrink-0">
                                            <i class="text-purple-400 fas fa-image"></i>
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-900">{{ $gallery->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                                    {{ $gallery->category ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ Str::limit(strip_tags($gallery->description), 60) ?: '—' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.galleries.edit', $gallery) }}"
                                        class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST"
                                        onsubmit="return confirm('Hapus foto \'{{ addslashes($gallery->title) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
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
                                <i class="mb-3 text-4xl text-gray-300 fas fa-images"></i>
                                <p class="text-gray-500">Belum ada foto di galeri.</p>
                                <a href="{{ route('admin.galleries.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus"></i> Tambah Foto Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $galleries->links() }}</div>

@endsection
