@extends('layout')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-10">
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
        
        <div class="pagination-wrapper p-6">
            {{ $mahasiswas->links() }}
        </div>

    </div>
@endsection
