@extends('admin.layout')

@section('page_title', 'Berita & Artikel')
@section('page_subtitle', 'Kelola berita dan artikel sekolah')

@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Berita</h3>
            <p class="text-sm text-gray-500">
                @if ($search)
                    Hasil pencarian "<span class="font-medium text-blue-600">{{ $search }}</span>"
                    &mdash; <span class="font-medium">{{ $news->total() }}</span> ditemukan
                @else
                    Total <span class="font-medium">{{ $news->total() }}</span> artikel
                @endif
            </p>
        </div>
        <a href="{{ route('admin.news.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 shadow-sm hover:shadow-md">
            <i class="fas fa-plus text-xs"></i> Tambah Berita
        </a>
    </div>

    {{-- SEARCH BAR --}}
    <form method="GET" action="{{ route('admin.news.index') }}" id="search-form" class="mb-5">
        <div class="flex items-center gap-3 max-w-sm">
            <div class="relative flex-1">

                {{-- Search icon --}}
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <i id="search-icon" class="fas fa-search text-gray-400 text-sm transition-colors duration-200"></i>
                </div>

                <input type="text" name="search" id="search-input" value="{{ $search }}"
                    placeholder="Cari judul, penulis..." autocomplete="off" spellcheck="false"
                    class="block w-full pl-10 pr-9 py-2.5 text-sm text-gray-900 bg-white border border-gray-300
                           rounded-lg shadow-sm placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           transition-all duration-200">

                {{-- Tombol X clear --}}
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    @if ($search)
                        <a href="{{ route('admin.news.index') }}"
                            class="flex items-center justify-center w-5 h-5 rounded-full text-gray-400 hover:text-white hover:bg-red-400 transition-all duration-150"
                            title="Hapus pencarian">
                            <i class="fas fa-times text-xs"></i>
                        </a>
                    @else
                        <button type="button" id="clear-btn"
                            class="hidden flex items-center justify-center w-5 h-5 rounded-full text-gray-400 hover:text-white hover:bg-red-400 transition-all duration-150"
                            title="Hapus pencarian">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    @endif
                </div>
            </div>

            {{-- Spinner --}}
            <div id="search-spinner" class="hidden items-center gap-1.5 text-xs text-gray-500 whitespace-nowrap">
                <i class="fas fa-circle-notch fa-spin text-blue-500"></i>
                <span>Mencari...</span>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="overflow-hidden bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul
                            Berita</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-28">
                            Status</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-36">
                            Tanggal Tayang</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-40">
                            Penulis</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-32">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($news as $article)
                        <tr class="hover:bg-blue-50/40 transition-colors duration-150 group">

                            {{-- Judul --}}
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if ($article->featured_image)
                                        <img src="{{ url('/files/' . $article->featured_image) }}"
                                            alt="{{ $article->title }}"
                                            class="w-10 h-10 object-cover rounded-lg shrink-0 ring-2 ring-white shadow-sm">
                                    @else
                                        <div
                                            class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg shrink-0">
                                            <i class="fas fa-newspaper text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p
                                            class="font-medium text-gray-900 group-hover:text-blue-700 transition-colors duration-150 line-clamp-1">
                                            {{ $article->title }}
                                        </p>
                                        @if ($article->excerpt)
                                            <p class="mt-0.5 text-xs text-gray-400 line-clamp-1">
                                                {{ Str::limit(strip_tags($article->excerpt ?? ''), 80) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-3.5">
                                @if ($article->status === 'published')
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                        Tayang
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                        Draft
                                    </span>
                                @endif
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-6 py-3.5 text-gray-500">
                                @if ($article->published_at)
                                    <div class="text-sm">{{ $article->published_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $article->published_at->format('H:i') }} WIB
                                    </div>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>

                            {{-- Penulis --}}
                            <td class="px-6 py-3.5 text-gray-600">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-blue-500 rounded-full shrink-0">
                                        {{ strtoupper(substr($article->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="text-sm">{{ $article->user->name ?? 'Tidak diketahui' }}</span>
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.news.edit', $article) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                               text-blue-700 bg-blue-50 border border-blue-200 rounded-lg
                                               hover:bg-blue-600 hover:text-white hover:border-blue-600
                                               active:bg-blue-700 transition-all duration-150 whitespace-nowrap">
                                        <i class="fas fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                                        onsubmit="return confirmDelete('{{ addslashes($article->title) }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                                   text-red-600 bg-red-50 border border-red-200 rounded-lg
                                                   hover:bg-red-600 hover:text-white hover:border-red-600
                                                   active:bg-red-700 transition-all duration-150 whitespace-nowrap">
                                            <i class="fas fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i
                                            class="fas {{ $search ? 'fa-magnifying-glass' : 'fa-newspaper' }} text-2xl text-gray-400"></i>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-sm font-semibold text-gray-700">
                                            {{ $search ? 'Tidak ada hasil untuk "' . $search . '"' : 'Belum ada berita' }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            {{ $search ? 'Coba kata kunci lain atau hapus pencarian' : 'Mulai tambahkan berita sekarang' }}
                                        </p>
                                    </div>
                                    @if ($search)
                                        <a href="{{ route('admin.news.index') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium
                                                  text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                            <i class="fas fa-arrow-left text-xs"></i> Lihat semua berita
                                        </a>
                                    @else
                                        <a href="{{ route('admin.news.create') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold
                                                  text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                                            <i class="fas fa-plus text-xs"></i> Tambah Berita Pertama
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if ($news->hasPages())
        <div class="mt-5">
            {{ $news->appends(request()->query())->links() }}
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        (function() {
            const input = document.getElementById('search-input');
            const form = document.getElementById('search-form');
            const spinner = document.getElementById('search-spinner');
            const clearBtn = document.getElementById('clear-btn');
            const icon = document.getElementById('search-icon');

            if (!input || !form) return;

            let timer = null;
            const DELAY = 350;

            function doSubmit() {
                if (icon) {
                    icon.className = 'fas fa-circle-notch fa-spin text-blue-400 text-sm';
                }
                if (spinner) spinner.classList.replace('hidden', 'flex');
                form.submit();
            }

            if (clearBtn) {
                if (input.value.length > 0) clearBtn.classList.remove('hidden');

                clearBtn.addEventListener('click', function() {
                    input.value = '';
                    clearBtn.classList.add('hidden');
                    doSubmit();
                });
            }

            input.addEventListener('input', function() {
                const val = this.value.trim();

                if (clearBtn) clearBtn.classList.toggle('hidden', val.length === 0);

                clearTimeout(timer);

                if (val === '') {
                    doSubmit();
                    return;
                }

                if (val.length < 2) return;

                timer = setTimeout(doSubmit, DELAY);
            });

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(timer);
                    doSubmit();
                }
                if (e.key === 'Escape') {
                    clearTimeout(timer);
                    this.value = '';
                    if (clearBtn) clearBtn.classList.add('hidden');
                    doSubmit();
                }
            });

            input.addEventListener('focus', function() {
                if (icon && !icon.classList.contains('fa-spin')) {
                    icon.classList.replace('text-gray-400', 'text-blue-500');
                }
            });
            input.addEventListener('blur', function() {
                if (icon && !icon.classList.contains('fa-spin')) {
                    icon.classList.replace('text-blue-500', 'text-gray-400');
                }
            });
        })();

        function confirmDelete(name) {
            return confirm('Hapus berita "' + name + '"?\n\nBerita yang dihapus tidak dapat dikembalikan.');
        }
    </script>
@endpush
