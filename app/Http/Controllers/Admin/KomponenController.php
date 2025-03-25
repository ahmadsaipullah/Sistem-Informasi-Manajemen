<?php

namespace App\Http\Controllers\Admin;

use App\Models\Komponen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class KomponenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $komponens = Komponen::all();
        return view('pages.admin.komponen.index', compact('komponens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_komponen' => ['required', 'string', 'unique:komponens,kode_komponen'],
            'nama_komponen' => ['required', 'string'],
            'stok' => ['required', 'integer'],
        ]);

        $komponen = Komponen::create($request->all());

        if ($komponen) {
            Alert::success('Sukses', 'Data berhasil ditambah!');
        } else {
            Alert::error('Gagal', 'Data gagal ditambahkan!');
        }

        return redirect()->route('komponen.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'kode_komponen' => ['required', 'string', 'unique:komponens,kode_komponen,' . $id],
                'nama_komponen' => ['required', 'string'],
                'stok' => ['required', 'integer'],
            ]);

            $komponen = Komponen::findOrFail($id);
            $updated = $komponen->update($request->all());

            if ($updated) {
                Alert::success('Sukses', 'Data berhasil diupdate!');
            } else {
                Alert::error('Gagal', 'Data gagal diupdate!');
            }

            return redirect()->route('komponen.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::warning('Peringatan', 'Kode produk sudah ada!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat mengupdate data!');
            return redirect()->back()->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $komponen = Komponen::findOrFail($id);
        $deleted = $komponen->delete();

        if ($deleted) {
            Alert::success('Sukses', 'Data berhasil dihapus!');
        } else {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data!');
        }

        return redirect()->route('komponen.index');
    }
}
