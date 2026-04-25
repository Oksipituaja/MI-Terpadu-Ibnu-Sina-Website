@extends('admin.layout')

@section('page_title', 'Data Guru')
@section('page_subtitle', 'Kelola informasi guru dan pengajar')

@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Guru</h3>
            <p class="text-sm text-gray-500">
                @if ($search)
                    Hasil pencarian "<span class="font-medium text-blue-600">{{ $search }}</span>"
                    &mdash; <span class="font-medium">{{ $teachers->total() }}</span> ditemukan
                @else
                    Total <span class="font-medium">{{ $teachers->total() }}</span> guru terdaftar
                @endif
            </p>
        </div>
        <a href="{{ route('admin.teachers.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 shadow-sm hover:shadow-md">
            <i class="fas fa-plus text-xs"></i> Tambah Guru
        </a>
    </div>

    {{-- SEARCH BAR --}}
    <form method="GET" action="{{ route('admin.teachers.index') }}" id="search-form" class="mb-5">
        <div class="flex items-center gap-3 max-w-sm">
            <div class="relative flex-1">

                {{-- Search icon --}}
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <i id="search-icon" class="fas fa-search text-gray-400 text-sm transition-colors duration-200"></i>
                </div>

                <input type="text" name="search" id="search-input" value="{{ $search }}"
                    placeholder="Cari guru..." autocomplete="off" spellcheck="false"
                    class="block w-full pl-10 pr-9 py-2.5 text-sm text-gray-900 bg-white border border-gray-300
                           rounded-lg shadow-sm placeholder-gray-400
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                           transition-all duration-200">

                {{-- Tombol X clear --}}
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    @if ($search)
                        <a href="{{ route('admin.teachers.index') }}"
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
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-64">
                            Nama Guru</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-36">
                            Jabatan/Mapel</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-36">
                            No. Telepon</th>
                        <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-32">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-blue-50/40 transition-colors duration-150 group">

                            {{-- Nama Guru --}}
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if ($teacher->featured_image)
                                        <img src="{{ url('/files/' . $teacher->featured_image) }}"
                                            alt="{{ $teacher->name }}"
                                            class="w-9 h-9 object-cover rounded-full shrink-0 ring-2 ring-white shadow-sm">
                                    @else
                                        {{-- Avatar fallback dengan inisial + warna dinamis --}}
                                        @php
                                            $initials = collect(explode(' ', $teacher->name))
                                                ->take(2)
                                                ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                                ->implode('');

                                            $colors = [
                                                'bg-blue-500',
                                                'bg-violet-500',
                                                'bg-emerald-500',
                                                'bg-rose-500',
                                                'bg-amber-500',
                                                'bg-cyan-500',
                                                'bg-pink-500',
                                                'bg-teal-500',
                                                'bg-indigo-500',
                                            ];
                                            $colorClass = $colors[abs(crc32($teacher->name)) % count($colors)];
                                        @endphp
                                        <div
                                            class="w-9 h-9 rounded-full {{ $colorClass }} flex items-center justify-center shrink-0 ring-2 ring-white shadow-sm">
                                            <span
                                                class="text-white text-xs font-bold tracking-wide">{{ $initials }}</span>
                                        </div>
                                    @endif
                                    <span
                                        class="font-medium text-gray-900 group-hover:text-blue-700 transition-colors duration-150">
                                        {{ $teacher->name }}
                                    </span>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="px-6 py-3.5 text-gray-500">
                                {{ $teacher->email }}
                            </td>

                            {{-- Jabatan --}}
                            <td class="px-6 py-3.5">
                                @if ($teacher->subject)
                                    @php
                                        $s = strtolower($teacher->subject);
                                        [$bg, $txt] = match (true) {
                                            str_contains($s, 'kepala sekolah') => ['bg-purple-100', 'text-purple-700'],
                                            str_contains($s, 'wakil') || str_contains($s, 'waka') => [
                                                'bg-indigo-100',
                                                'text-indigo-700',
                                            ],
                                            default => ['bg-sky-100', 'text-sky-700'],
                                        };
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $bg }} {{ $txt }} whitespace-nowrap">
                                        {{ $teacher->subject }}
                                    </span>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>

                            {{-- Telepon --}}
                            <td class="px-6 py-3.5 text-gray-500 tabular-nums">
                                {{ $teacher->phone ?? '—' }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                               text-blue-700 bg-blue-50 border border-blue-200 rounded-lg
                                               hover:bg-blue-600 hover:text-white hover:border-blue-600
                                               active:bg-blue-700 transition-all duration-150 whitespace-nowrap">
                                        <i class="fas fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                                        onsubmit="return confirmDelete('{{ addslashes($teacher->name) }}')">
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
                                            class="fas {{ $search ? 'fa-magnifying-glass' : 'fa-chalkboard-user' }} text-2xl text-gray-400"></i>
                                    </div>
                                    <div class="space-y-1">
                                        <p class="text-sm font-semibold text-gray-700">
                                            {{ $search ? 'Tidak ada hasil untuk "' . $search . '"' : 'Belum ada data guru' }}
                                        </p>
                                        <p class="text-xs text-gray-400">
                                            {{ $search ? 'Coba kata kunci lain atau hapus pencarian' : 'Mulai tambahkan guru sekarang' }}
                                        </p>
                                    </div>
                                    @if ($search)
                                        <a href="{{ route('admin.teachers.index') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium
                                                  text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                            <i class="fas fa-arrow-left text-xs"></i> Lihat semua guru
                                        </a>
                                    @else
                                        <a href="{{ route('admin.teachers.create') }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold
                                                  text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors">
                                            <i class="fas fa-plus text-xs"></i> Tambah Guru Pertama
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
    @if ($teachers->hasPages())
        <div class="mt-5">
            {{ $teachers->appends(request()->query())->links() }}
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
            const DELAY = 350; // cepat tapi tidak membebani server

            function doSubmit() {
                // Ganti icon jadi spinner
                if (icon) {
                    icon.className = 'fas fa-circle-notch fa-spin text-blue-400 text-sm';
                }
                if (spinner) spinner.classList.replace('hidden', 'flex');
                form.submit();
            }

            // Clear button
            if (clearBtn) {
                if (input.value.length > 0) clearBtn.classList.remove('hidden');

                clearBtn.addEventListener('click', function() {
                    input.value = '';
                    clearBtn.classList.add('hidden');
                    doSubmit();
                });
            }

            // Input handler
            input.addEventListener('input', function() {
                const val = this.value.trim();

                if (clearBtn) clearBtn.classList.toggle('hidden', val.length === 0);

                clearTimeout(timer);

                // Kosong → reset langsung
                if (val === '') {
                    doSubmit();
                    return;
                }

                // Minimal 2 karakter
                if (val.length < 2) return;

                timer = setTimeout(doSubmit, DELAY);
            });

            // Keyboard shortcuts
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

            // Focus highlight icon
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
            return confirm('Hapus guru "' + name + '"?\n\nData yang dihapus tidak dapat dikembalikan.');
        }
    </script>
@endpush
