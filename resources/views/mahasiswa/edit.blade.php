{{-- @extends('layout')

@section('title', 'Edit Mahasiswa')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex justify-center items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Data Mahasiswa</h1>
        </div>

        <div class="flex justify-center mb-6">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama" value="{{ $mahasiswa->nama }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="text" name="nip" id="nip" value="{{ $mahasiswa->nip }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class="mb-4">
                        <label for="universitas" class="block text-sm font-medium text-gray-700">Universitas</label>
                        <input type="text" name="universitas" id="universitas" value="{{ $mahasiswa->universitas }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div class= "mb-4">
                        <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto" id="foto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $mahasiswa->keterangan }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">Batal</a>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection --}}
