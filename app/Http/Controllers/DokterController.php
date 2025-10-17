<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    /**
     * Tampilkan daftar dokter.
     */
    public function index()
    {
        // Ambil semua user dengan role 'dokter' dan relasi poli-nya
        $dokters = User::where('role', 'dokter')->with('poli')->get();

        return view('admin.dokter.index', compact('dokters'));
    }

    /**
     * Form tambah dokter.
     */
    public function create()
    {
        $poli = Poli::all();
        return view('admin.dokter.create', compact('poli'));
    }

    /**
     * Simpan data dokter baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp',
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|integer|exists:poli,id', // pastikan tabelnya benar: 'poli'
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6',
        ]);

        // Jika tidak ada password diisi, buat default
        $password = $validated['password'] ?? 'dokter123';

        User::create([
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'no_ktp' => $validated['no_ktp'],
            'no_hp' => $validated['no_hp'],
            'id_poli' => $validated['id_poli'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'role' => 'dokter',
        ]);

        return redirect()->route('dokter.index')
            ->with('success', 'Data Dokter berhasil ditambahkan!');
    }

    /**
     * Form edit dokter.
     */
    public function edit(User $dokter)
    {
        $poli = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'poli'));
    }

    /**
     * Update data dokter.
     */
    public function update(Request $request, User $dokter)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:16|unique:users,no_ktp,' . $dokter->id,
            'no_hp' => 'required|string|max:15',
            'id_poli' => 'required|integer|exists:poli,id',
            'email' => 'required|email|unique:users,email,' . $dokter->id,
            'password' => 'nullable|string|min:6',
        ]);

        // Update data umum
        $dokter->update([
            'nama' => $validated['nama'],
            'alamat' => $validated['alamat'],
            'no_ktp' => $validated['no_ktp'],
            'no_hp' => $validated['no_hp'],
            'id_poli' => $validated['id_poli'],
            'email' => $validated['email'],
        ]);

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $dokter->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        return redirect()->route('dokter.index')
            ->with('success', 'Data Dokter berhasil diperbarui!');
    }

    /**
     * Hapus data dokter.
     */
    public function destroy(User $dokter)
    {
        $dokter->delete();

        return redirect()->route('dokter.index')
            ->with('success', 'Data Dokter berhasil dihapus!');
    }

        /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        // Total dokter
        $totalDokter = \App\Models\User::where('role', 'dokter')->count();

        // Total Poli
        $totalPoli = \App\Models\Poli::count();

        // Jika belum ada tabel janji & pasien, ini bisa diisi nol dulu
        $janjiHariIni = 0;
        $pasienBaru = 0;

        return view('admin.dashboard', compact('totalDokter', 'totalPoli', 'janjiHariIni', 'pasienBaru'));
    }

}
