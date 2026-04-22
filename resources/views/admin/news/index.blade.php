@extends('admin.layout')

@section('page_title', 'Berita & Artikel')
@section('page_subtitle', 'Kelola berita dan artikel sekolah')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Berita</h3>
            <p class="text-sm text-gray-500">Total {{ $news->total() }} artikel</p>
        </div>
        <a href="{{ route('admin.news.create') }}"
            class="flex items-center gap-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Judul Berita</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Tanggal Tayang</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Penulis</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($news as $article)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($article->featured_image)
                                        <img src="{{ url('/files/' . $article->featured_image) }}"
                                            alt="{{ $article->title }}" class="object-cover w-10 h-10 rounded-lg shrink-0">
                                    @else
                                        <div
                                            class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg shrink-0">
                                            <i class="text-gray-400 fas fa-newspaper"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <a href="{{ route('admin.news.edit', $article) }}"
                                            class="text-sm font-medium text-gray-900 hover:text-blue-600 line-clamp-1">
                                            {{ $article->title }}
                                        </a>
                                        @if ($article->excerpt)
                                            <p class="mt-0.5 text-xs text-gray-400 line-clamp-1">
                                                {{ Str::limit(strip_tags($article->excerpt ?? ''), 80) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($article->status === 'published')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        Tayang
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($article->published_at)
                                    <div>{{ $article->published_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $article->published_at->format('H:i') }} WIB</div>
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="flex items-center justify-center w-6 h-6 text-xs font-semibold text-white bg-blue-500 rounded-full">
                                        {{ strtoupper(substr($article->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    {{ $article->user->name ?? 'Tidak diketahui' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.news.edit', $article) }}"
                                        class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                                        onsubmit="return confirm('Hapus berita \'{{ addslashes($article->title) }}\'?\n\nBerita yang dihapus tidak dapat dikembalikan.')">
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
                                <i class="mb-3 text-4xl text-gray-300 fas fa-newspaper"></i>
                                <p class="text-gray-500">Belum ada berita.</p>
                                <a href="{{ route('admin.news.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus"></i> Tambah Berita Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $news->links() }}</div>

@endsection
