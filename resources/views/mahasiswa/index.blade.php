@extends('layout')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-2xl font-bold mx-auto">Data Mahasiswa</h1>
            <button 
                type="button" 
                onclick="openCreateModal()"
                class="transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 duration-300 hover:bg-blue-600 text-white py-2 px-4 rounded-full"
            >
                Tambah Data
            </button>

            {{-- <button 
                type="button" 
                onclick="window.location.href='{{ route('mahasiswa.create') }}';" 
                class="transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 duration-300 hover:bg-blue-600 text-white py-2 px-4 rounded-full"
            >
                Tambah Data
            </button> --}}
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
                    <p class="text-gray-600">Keterangan: {{ $mahasiswa->keterangan }}</p>
                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="button" 
                                onclick="openModal('editDataModal', { id: {{ $mahasiswa->id }}, nama: '{{ $mahasiswa->nama }}', nip: '{{ $mahasiswa->nip }}', universitas: '{{ $mahasiswa->universitas }}', keterangan: '{{ $mahasiswa->keterangan }}' })" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">
                            Edit
                        </button>

                        {{-- <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded">Edit</a> --}}

                        <button type="button" onclick="openDeleteModal({{ $mahasiswa->id }})" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded">Delete</button>

                        {{-- <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form> --}}
                    </div>
                </div>
            @endforeach
        </div> 
        
        <div class="pagination-wrapper p-6 bg-gray-100">
            {{ $mahasiswas->links() }}
        </div>

        {{-- Modal Tambah Data --}}
        <div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Tambah Data Mahasiswa</h2>
                        <button onclick="closeCreateModal()" class="text-gray-600 hover:text-gray-900">✖</button>
                    </div>
    
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    
                    <form id="createForm" action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
    
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
    
                        <div class="mb-4">
                            <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                            <input type="number" name="nip" id="nip" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
    
                        <div class="mb-4">
                            <label for="universitas" class="block text-sm font-medium text-gray-700">Universitas</label>
                            <input type="text" name="universitas" id="universitas" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        </div>
    
                        <div class="mb-4">
                            <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                            <input type="file" name="foto" id="foto" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm onchange="validateFile(this)">
                        </div>
    
                        <div class="mb-4">
                            <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
    
                        <div class="flex justify-end">
                            <button type="button" onclick="closeCreateModal()" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">Batal</button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data -->
        <div id="editDataModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">Edit Data Mahasiswa</h3>
                    <button onclick="closeModal('editDataModal')" class="text-gray-600 hover:text-gray-900">✖</button>
                </div>

                <form id="editDataForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-4">
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="edit_nama" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="edit_nip" class="block text-sm font-medium text-gray-700">NIP</label>
                        <input type="number" name="nip" id="edit_nip" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="edit_universitas" class="block text-sm font-medium text-gray-700">Universitas</label>
                        <input type="text" name="universitas" id="edit_universitas" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="edit_foto" class="block text-sm font-medium text-gray-700">Foto</label>
                        <input type="file" name="foto" id="edit_foto" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm onchange="validateFile(this)">
                    </div>

                    <div class="mb-4">
                        <label for="edit_keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <textarea name="keterangan" id="edit_keterangan" rows="3" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal('editDataModal')" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded mr-2">Batal</button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Modal Konfirmasi Hapus -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Konfirmasi Hapus</h3>
                    <button onclick="closeModal('deleteModal')" class="text-gray-600 hover:text-gray-900">✖</button>
                </div>
                <p class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
                <form id="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-4">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md" onclick="closeModal('deleteModal')">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md">Hapus</button>
                    </div>
                </form>
                <div id="successMessage" class="hidden">
                    <p class="mb-4">Data berhasil dihapus.</p>
                    <div class="flex justify-end">
                        <button onclick="closeModal('confirmationModal')" class="px-4 py-2 bg-blue-500 text-white rounded-md">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="alertModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Notification</h3>
                    <button onclick="closeModal('alertModal')" class="text-gray-600 hover:text-gray-900">✖</button>
                </div>
                <p id="modalMessage"></p>
                <div class="flex justify-end">
                    <button id="closeModal" class="px-4 py-2 bg-blue-500 text-white rounded-md">Close</button>
                </div>
            </div>
        </div>

        <script>
            function openCreateModal() {
                document.getElementById('createModal').classList.remove('hidden');
            }
    
            function closeCreateModal() {
                document.getElementById('createModal').classList.add('hidden');
            }

            function openModal(modalId, data = {}) {
                const modal = document.getElementById(modalId);
        
                if (modalId === 'editDataModal') {
                    // Isi data ke form edit
                    document.getElementById('edit_id').value = data.id || '';
                    document.getElementById('edit_nama').value = data.nama || '';
                    document.getElementById('edit_nip').value = data.nip || '';
                    document.getElementById('edit_universitas').value = data.universitas || '';
                    document.getElementById('edit_keterangan').value = data.keterangan || '';
                    // Update action URL
                    document.getElementById('editDataForm').action = `/mahasiswa/update/${data.id}`;
                }
        
                // Tampilkan modal
                modal.classList.remove('hidden');
            }
        
            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                // Sembunyikan modal
                modal.classList.add('hidden');
            }

            function openDeleteModal(id) {
                const modal = document.getElementById('deleteModal');
                // Update action URL
                document.getElementById('deleteForm').action = `/mahasiswa/destroy/${id}`;
                // Tampilkan modal
                modal.classList.remove('hidden');
            }

            function openDeleteModal(id) {
                const modal = document.getElementById('deleteModal');
                document.getElementById('deleteForm').action = `/mahasiswa/destroy/${id}`;
                modal.classList.remove('hidden');
            }

            function validateFile(input) {
                const file = input.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                
                if (file && !allowedTypes.includes(file.type)) {
                    showAlert('File must be a JPEG, PNG, or GIF image.');
                    input.value = ''; // Hapus file yang tidak valid
                }
            }

            function showAlert(message) {
                const alertModal = document.getElementById('alertModal');
                const modalMessage = document.getElementById('modalMessage');
                
                modalMessage.textContent = message;
                alertModal.classList.remove('hidden');
                alertModal.style.display = 'flex';
            }

            document.getElementById('foto')?.addEventListener('change', function() {
                validateFile(this);
            });

            document.getElementById('edit_foto')?.addEventListener('change', function() {
                validateFile(this);
            });

            document.addEventListener('DOMContentLoaded', (event) => {
                const alertModal = document.getElementById('alertModal');
                const modalMessage = document.getElementById('modalMessage');
                const closeModal = document.getElementById('closeModal');

                @if(session('success') || $errors->has('error'))
                    modalMessage.textContent = "{{ session('success') ?? $errors->first('error') }}";
                    alertModal.classList.remove('hidden');
                    alertModal.style.display = 'flex';
                @endif

                closeModal.addEventListener('click', () => {
                    alertModal.style.display = 'none';
                });
            });
        </script>        
    </div>
@endsection
