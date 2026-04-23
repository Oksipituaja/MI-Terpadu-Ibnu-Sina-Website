@extends('admin.layout')

@section('page_title', 'Agenda Kegiatan')
@section('page_subtitle', 'Kelola agenda dan kegiatan sekolah')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Kegiatan</h3>
            <p class="text-sm text-gray-500">Total {{ $agendas->total() }} kegiatan</p>
        </div>
        <a href="{{ route('admin.agendas.create') }}"
            class="flex items-center gap-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus"></i> Tambah Kegiatan
        </a>
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Judul Kegiatan</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Tanggal & Jam</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Lokasi</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($agendas as $agenda)
                        @php
                            $statusMap = [
                                'upcoming' => [
                                    'label' => 'Mendatang',
                                    'class' => 'bg-blue-100 text-blue-700',
                                    'icon' => 'fa-clock',
                                ],
                                'ongoing' => [
                                    'label' => 'Berlangsung',
                                    'class' => 'bg-yellow-100 text-yellow-700',
                                    'icon' => 'fa-circle-notch fa-spin',
                                ],
                                'completed' => [
                                    'label' => 'Selesai',
                                    'class' => 'bg-gray-100 text-gray-600',
                                    'icon' => 'fa-check',
                                ],
                            ];
                            $s = $statusMap[$agenda->status] ?? [
                                'label' => ucfirst($agenda->status),
                                'class' => 'bg-gray-100 text-gray-600',
                                'icon' => 'fa-circle',
                            ];
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $agenda->title }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div>{{ $agenda->event_date->translatedFormat('d M Y') }}</div>
                                <div class="text-xs text-gray-400">
                                    {{ $agenda->formatted_time ? $agenda->formatted_time . ' WIB' : '—' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $agenda->location ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium {{ $s['class'] }}">
                                    <i class="fas {{ $s['icon'] }}"></i>
                                    {{ $s['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.agendas.edit', $agenda) }}"
                                        class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.agendas.destroy', $agenda) }}" method="POST"
                                        onsubmit="return confirm('Hapus kegiatan \'{{ addslashes($agenda->title) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
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
                                <i class="mb-3 text-4xl text-gray-300 fas fa-calendar"></i>
                                <p class="text-gray-500">Belum ada agenda kegiatan.</p>
                                <a href="{{ route('admin.agendas.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus"></i> Tambah Kegiatan Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $agendas->links() }}</div>

@endsection
