<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Query pencarian data berdasarkan nama
        $mahasiswas = Mahasiswa::where('nama', 'like', "%$search%")->get();
        $mahasiswas = Mahasiswa::where('nip', 'like', "%$search%")->get();
        $mahasiswas = Mahasiswa::where('universitas', 'like', "%$search%")->get();
        $mahasiswas = Mahasiswa::where('keterangan', 'like', "%$search%")->get();
        //
        return view('mahasiswa.index', compact('mahasiswas', 'search'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:mahasiswas,nip',
            'universitas' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        // Simpan data ke database
        Mahasiswa::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'universitas' => $request->universitas,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:mahasiswas,nip,' . $mahasiswa->id,
            'universitas' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $mahasiswa->update([
                'nama' => $request->nama,
                'nip' => $request->nip,
                'universitas' => $request->universitas,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update Mahasiswa. Please try again.']);
        }
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        try {
            $mahasiswa->delete();
            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete Mahasiswa. Please try again.']);
        }
    }

    
}
