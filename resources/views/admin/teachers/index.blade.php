@extends('admin.layout')

@section('page_title', 'Data Guru')
@section('page_subtitle', 'Kelola informasi guru dan pengajar')

@section('content')

    <div class="flex items-center justify-between mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Daftar Guru</h3>
            <p class="text-sm text-gray-500">Total {{ $teachers->total() }} guru</p>
        </div>
        <a href="{{ route('admin.teachers.create') }}"
            class="flex items-center gap-2 px-4 py-2 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus"></i> Tambah Guru
        </a>
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Nama Guru</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Email</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Jabatan/Mapel</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">No. Telepon</th>
                        <th class="px-6 py-3 text-xs font-semibold text-left text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($teacher->featured_image)
                                        <img src="{{ url('/files/' . $teacher->featured_image) }}"
                                            alt="{{ $teacher->name }}" class="object-cover w-10 h-10 rounded-full shrink-0">
                                    @else
                                        <div
                                            class="flex items-center justify-center w-10 h-10 text-sm font-semibold text-white bg-blue-500 rounded-full shrink-0">
                                            {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="text-sm font-medium text-gray-900">{{ $teacher->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $teacher->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $teacher->subject ?? '—' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $teacher->phone ?? '—' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                        class="flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST"
                                        onsubmit="return confirm('Hapus guru \'{{ addslashes($teacher->name) }}\'?\n\nData yang dihapus tidak dapat dikembalikan.')">
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
                                <i class="mb-3 text-4xl text-gray-300 fas fa-chalkboard-user"></i>
                                <p class="text-gray-500">Belum ada data guru.</p>
                                <a href="{{ route('admin.teachers.create') }}"
                                    class="inline-flex items-center gap-2 px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                    <i class="fas fa-plus"></i> Tambah Guru Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $teachers->links() }}</div>

@endsection
