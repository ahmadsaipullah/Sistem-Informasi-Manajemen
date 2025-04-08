<?php

namespace App\Http\Controllers\Admin;

use App\Models\HasilProduksi;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class HasilProduksiController extends Controller
{
    /**
     * Tampilkan semua data hasil produksi.
     */
    public function index()
    {
        $hasilProduksis = HasilProduksi::with('produksi')->get();
        return view('pages.admin.hasil-produksi.index', compact('hasilProduksis'));
    }

    /**
     * Simpan data hasil produksi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'produksi_id' => ['required', 'exists:wip_komponens,id'],
            'jam'         => ['required', 'string'],
            'shift'       => ['required', 'string'],
            'hasil'       => ['required', 'string'],
            'target'      => ['required', 'string'],
            'hambatan'    => ['nullable', 'string'],
        ]);

        // Cek apakah produksi_id sudah digunakan
        $existing = HasilProduksi::where('produksi_id', $request->produksi_id)->first();

        if ($existing) {
            Alert::warning('Peringatan', 'Data hasil produksi untuk ID ini sudah ada!');
            return redirect()->back()->withInput();
        }

        $hasil = HasilProduksi::create($request->all());

        if ($hasil) {
            Alert::success('Sukses', 'Data hasil produksi berhasil ditambahkan!');
        } else {
            Alert::error('Gagal', 'Data hasil produksi gagal ditambahkan!');
        }

        return redirect()->route('hasil-produksi.index');
    }


    /**
     * Update data hasil produksi.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'produksi_id' => ['required', 'exists:wip_komponens,id'],
            'jam'         => ['required', 'string'],
            'shift'       => ['required', 'string'],
            'hasil'       => ['required', 'string'],
            'target'      => ['required', 'string'],
            'hambatan'    => ['nullable', 'string'],
        ]);

        $hasil = HasilProduksi::findOrFail($id);
        $updated = $hasil->update($request->all());

        if ($updated) {
            Alert::success('Sukses', 'Data hasil produksi berhasil diperbarui!');
        } else {
            Alert::error('Gagal', 'Data hasil produksi gagal diperbarui!');
        }

        return redirect()->route('hasil-produksi.index');
    }

    /**
     * Hapus data hasil produksi.
     */
    public function destroy(string $id)
    {
        $hasil = HasilProduksi::findOrFail($id);
        $deleted = $hasil->delete();

        if ($deleted) {
            Alert::success('Sukses', 'Data hasil produksi berhasil dihapus!');
        } else {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data hasil produksi!');
        }

        return redirect()->route('hasil-produksi.index');
    }


    public function exportPdf()
{
    $hasilProduksis = HasilProduksi::with(['produksi.orderRequest.komponen', 'produksi.orderRequest.operator'])->get();
    $pdf = PDF::loadView('pages.admin.hasil-produksi.pdf', compact('hasilProduksis'));
    return $pdf->download('hasil-produksi.pdf');
}
}
