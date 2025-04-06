<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mesin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class mesinController extends Controller
{
    /**
     * Tampilkan semua data mesin.
     */
    public function index()
    {
        $mesins = Mesin::all();
        return view('pages.admin.mesin.index', compact('mesins'));
    }

    /**
     * Simpan data mesin baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mesin' => ['required', 'string', 'unique:mesins,kode_mesin'],
            'nama_mesin' => ['required', 'string'],
        ]);

        $mesin = Mesin::create($request->all());

        if ($mesin) {
            Alert::success('Sukses', 'Data mesin berhasil ditambahkan!');
        } else {
            Alert::error('Gagal', 'Data mesin gagal ditambahkan!');
        }

        return redirect()->route('mesin.index');
    }

    /**
     * Update data mesin.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'kode_mesin' => ['required', 'string', 'unique:mesins,kode_mesin,' . $id],
                'nama_mesin' => ['required', 'string'],
            ]);

            $mesin = Mesin::findOrFail($id);
            $updated = $mesin->update($request->all());

            if ($updated) {
                Alert::success('Sukses', 'Data mesin berhasil diperbarui!');
            } else {
                Alert::error('Gagal', 'Data mesin gagal diperbarui!');
            }

            return redirect()->route('mesin.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::warning('Peringatan', 'Kode mesin sudah digunakan!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui data!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Hapus data mesin.
     */
    public function destroy(string $id)
    {
        $mesin = Mesin::findOrFail($id);
        $deleted = $mesin->delete();

        if ($deleted) {
            Alert::success('Sukses', 'Data mesin berhasil dihapus!');
        } else {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data mesin!');
        }

        return redirect()->route('mesin.index');
    }
}
