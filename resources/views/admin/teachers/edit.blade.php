@extends('admin.layout')
@section('page_title', 'Edit Guru')
@section('page_subtitle', 'Perbarui informasi guru')
@section('content')
    <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
        <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <input type="hidden" name="slug" value="{{ old('slug', $teacher->slug) }}">

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $teacher->name) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $teacher->email) }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">
                    No. Telepon <span class="ml-1 text-xs text-gray-400">(opsional)</span>
                </label>
                <input type="text" name="phone" value="{{ old('phone', $teacher->phone) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Jabatan/Mapel</label>
                <input type="text" name="subject" value="{{ old('subject', $teacher->subject) }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <x-image-crop-upload name="featured_image" label="Foto Guru" aspect-ratio="1/1" preview-class="w-40 h-40"
                :optional="true" :current-image="$teacher->featured_image ? url('/files/' . $teacher->featured_image) : null" :current-alt="$teacher->name" :error="$errors->first('featured_image_base64')" />

            <div class="flex gap-3 pt-4 border-t">
                @include('components.admin-submit-btn', [
                    'label' => 'Simpan Perubahan',
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
