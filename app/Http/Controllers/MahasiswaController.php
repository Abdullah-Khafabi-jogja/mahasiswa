<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa dengan pencarian.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Mengambil query pencarian dari URL (defaultnya adalah string kosong jika tidak ada)
        $search = $request->query('search', '');

        // Mengambil data mahasiswa dengan pencarian berdasarkan nama, nip, universitas, atau keterangan
        $mahasiswas = Mahasiswa::where('nama', 'like', "%$search%")
                            ->orWhere('nip', 'like', "%$search%")
                            ->orWhere('universitas', 'like', "%$search%")
                            ->orWhere('keterangan', 'like', "%$search%")
                            ->simplePaginate(6); // Menampilkan 6 data per halaman

        // Mengembalikan tampilan 'mahasiswa.index' dengan data mahasiswa dan query pencarian
        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    /**
     * Menampilkan formulir untuk menambahkan mahasiswa baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengembalikan tampilan 'mahasiswa.create' untuk menampilkan formulir
        return view('mahasiswa.create');
    }

    /**
     * Menyimpan data mahasiswa baru ke database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input dari formulir
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|digits_between:1,12|unique:mahasiswas,nip',
            'universitas' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto (jika ada)
            'keterangan' => 'nullable|string',
        ]);

        // Menyimpan foto (jika ada) ke direktori 'fotos' dalam penyimpanan publik
        $path = $this->storeFoto($request->file('foto'));

        try {
            // Menyimpan data mahasiswa ke database
            Mahasiswa::create([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'universitas' => $request->universitas,
                'foto' => $path,    
                'keterangan' => $request->keterangan,
            ]);

            // Mengalihkan ke halaman daftar mahasiswa dengan pesan sukses
            return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Mengalihkan kembali ke halaman sebelumnya dengan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to add Mahasiswa. Please try again.'])->with('showCreateModal', true);
        }
    }

    /**
     * Menampilkan formulir untuk mengedit data mahasiswa yang ada.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Mengambil data mahasiswa berdasarkan ID, jika tidak ditemukan akan memunculkan 404 error
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Mengembalikan tampilan 'mahasiswa.edit' dengan data mahasiswa untuk diedit
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Memperbarui data mahasiswa yang ada di database.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Mengambil data mahasiswa berdasarkan ID, jika tidak ditemukan akan memunculkan 404 error
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Validasi data input dari formulir
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|numeric|digits_between:1,12|unique:mahasiswas,nip,' . $id,
            'universitas' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto (jika ada)
            'keterangan' => 'nullable|string',
        ]);

        // Menyimpan foto (jika ada) ke direktori 'fotos' dalam penyimpanan publik
        // Jika tidak ada foto baru, menggunakan foto yang lama
        $path = $request->hasFile('foto') ? $this->storeFoto($request->file('foto')) : $mahasiswa->foto;

        try {
            // Memperbarui data mahasiswa di database
            $mahasiswa->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'universitas' => $request->universitas,
                'foto' => $path,
                'keterangan' => $request->keterangan,
            ]);

            // Mengalihkan ke halaman daftar mahasiswa dengan pesan sukses
            return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            // Mengalihkan kembali ke halaman sebelumnya dengan pesan error jika terjadi kesalahan
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update Mahasiswa. Please try again.'])->with('showEditModal', true)->with('editData', $request->all());
        }
    }

    /**
     * Menghapus data mahasiswa dari database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Mengambil data mahasiswa berdasarkan ID, jika tidak ditemukan akan memunculkan 404 error
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Menghapus foto jika ada
        if ($mahasiswa->foto) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }

    protected function storeFoto($foto)
    {
        return $foto ? $foto->store('fotos', 'public') : null;
    }
}
