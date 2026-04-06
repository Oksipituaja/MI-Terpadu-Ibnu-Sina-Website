@extends('admin.layout')
@section('page_title', 'Tambah Guru')
@section('page_subtitle', 'Tambah data guru baru')
@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.teachers.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="slug" id="slugInput" value="{{ old('slug') }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="nameInput" value="{{ old('name') }}" required
                    placeholder="cth: Budi Santoso, S.Pd"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    placeholder="cth: budi@sekolah.sch.id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    No. Telepon <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="cth: 08123456789"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Jabatan/Mapel</label>
                <input type="text" name="subject" value="{{ old('subject') }}"
                    placeholder="cth: Matematika, Bahasa Indonesia"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <x-image-crop-upload name="featured_image" label="Foto Guru" aspect-ratio="1/1" preview-class="w-40 h-40"
                :optional="true" :error="$errors->first('featured_image_base64')" />

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Guru',
                    'loading' => 'Menyimpan...',
                ])
                <a href="{{ route('admin.teachers.index') }}"
                    class="px-6 py-2 font-medium text-gray-800 bg-gray-200 rounded-lg hover:bg-gray-300">
                    <i class="mr-2 fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('nameInput');
            const slugInput = document.getElementById('slugInput');

            function generateSlug(t) {
                return t.toLowerCase().trim()
                    .replace(/[àáâãäå]/g, 'a').replace(/[èéêë]/g, 'e')
                    .replace(/[ìíîï]/g, 'i').replace(/[òóôõö]/g, 'o').replace(/[ùúûü]/g, 'u')
                    .replace(/[^a-z0-9\s-]/g, '').replace(/[\s-]+/g, '-').replace(/^-+|-+$/g, '');
            }

            nameInput.addEventListener('input', function() {
                slugInput.value = generateSlug(this.value);
            });
        });
    </script>
@endpush
