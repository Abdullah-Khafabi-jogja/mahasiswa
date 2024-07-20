@extends('layout')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-2xl font-bold mx-auto">Data Mahasiswa</h1>
            <button 
                type="button" 
                onclick="window.location.href='{{ route('mahasiswa.create') }}';" 
                class="transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 duration-300 hover:bg-blue-600 text-white py-2 px-4 rounded-full"
            >
                Tambah Data
            </button>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($mahasiswas as $mahasiswa)
                <div class="bg-white p-4 rounded-lg shadow-md mx-4">
                    <div class="flex justify-center mb-4">
                        @if($mahasiswa->foto)
                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto" class="w-16 h-16 rounded-full">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Foto" class="w-16 h-16 rounded-full">
                        @endif
                    </div>
                    <p class="text-gray-600">Nama: {{ $mahasiswa->nama }}</p>
                    <p class="text-gray-600">NIP: {{ $mahasiswa->nip }}</p>
                    <p class="text-gray-600">Universitas: {{ $mahasiswa->universitas }}</p>
                    {{-- <div class= m-4>
                        <p class="text-gray-600">Foto: {{ $mahasiswa->foto }}</p>
                        <input type="file" name="foto" id="foto" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div> --}}
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
