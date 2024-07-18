@extends('layout')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="container mx-auto py-12 p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold mx-auto">Data Mahasiswa</h1>
            <a href="{{ route('mahasiswa.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-full">Tambah Data</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($mahasiswas as $mahasiswa)
                <div class="bg-white p-4 rounded-lg shadow-md mx-4">
                    <p class="text-gray-600">Nama: {{ $mahasiswa->nama }}</p>
                    <p class="text-gray-600">NIP: {{ $mahasiswa->nip }}</p>
                    <p class="text-gray-600">Universitas: {{ $mahasiswa->universitas }}</p>
                    <p class="text-gray-600">Keterangan: {{ $mahasiswa->keterangan }}</p>
                    <div class="flex justify-end mt-4 space-x-2">
                        <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Edit</a>
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>        

    {{-- <!-- Modal -->
    <div id="myModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Tambah Data</h3>
                <div class="mt-2 px-7 py-3">
                    <form action="{{ route('mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                            <input type="text" name="nip" id="nip" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="universitas" class="block text-sm font-medium text-gray-700">Universitas</label>
                            <input type="text" name="universitas" id="universitas" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="closeModal()" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">Batal</button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('myModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('myModal').classList.add('hidden');
        }
    </script> --}}
@endsection
