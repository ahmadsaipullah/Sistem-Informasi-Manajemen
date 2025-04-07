<?php

namespace App\Http\Controllers\Admin;

use App\Models\WipKomponen;
use App\Models\Mesin;
use App\Models\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class WipKomponenController extends Controller
{
    /**
     * Menampilkan semua data WIP Komponen.
     */
    public function index()
    {
        $wip_komponens = WipKomponen::with(['orderRequest', 'mesin'])->get();
        $mesins = Mesin::all();
        $order_requests = OrderRequest::all();

        return view('pages.admin.wip_komponen.index', compact('wip_komponens', 'mesins', 'order_requests'));
    }

    /**
     * Menyimpan data WIP Komponen baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'komponen_id' => 'required|exists:order_requests,id',
            'mesin_id' => 'required|exists:mesins,id',
            'lokasi' => 'required|string|max:255',
            'tanggal_out' => 'required|date',
            'jumlah_out' => 'required|numeric|min:1',
        ]);

        $orderRequest = \App\Models\OrderRequest::findOrFail($request->komponen_id);

        // Hitung total jumlah_out yang sudah dicatat
        $totalWipOut = \App\Models\WipKomponen::where('komponen_id', $request->komponen_id)->sum('jumlah_out');

        $sisa = $orderRequest->jumlah - $totalWipOut;

        // Cek jika jumlah sudah habis
        if ($totalWipOut >= $orderRequest->jumlah) {
            Alert::error('Gagal', 'Jumlah out sudah mencapai batas maksimal untuk komponen ini.');
            return redirect()->back()->withInput();
        }

        // Cek jika input melebihi sisa
        if ($request->jumlah_out > $sisa) {
            Alert::error('Gagal', 'Jumlah out melebihi sisa order. Sisa saat ini: ' . $sisa);
            return redirect()->back()->withInput();
        }

        // Simpan data baru
        $create = \App\Models\WipKomponen::create([
            'komponen_id' => $request->komponen_id,
            'mesin_id' => $request->mesin_id,
            'lokasi' => $request->lokasi,
            'tanggal_out' => $request->tanggal_out,
            'jumlah_out' => $request->jumlah_out,
            'status' => $request->status ?? 'Selesai',
        ]);

        // Setelah simpan, hitung ulang jumlah_out
        $totalWipOutAfterInsert = \App\Models\WipKomponen::where('komponen_id', $request->komponen_id)->sum('jumlah_out');

        // Jika jumlah_out == jumlah, update status OrderRequest
        if ($totalWipOutAfterInsert == $orderRequest->jumlah) {
            $orderRequest->status = 'Selesai';
            $orderRequest->save();
        }

        if ($create) {
            Alert::success('Sukses', 'Data WIP Komponen berhasil ditambahkan!');
        } else {
            Alert::error('Gagal', 'Data WIP Komponen gagal ditambahkan!');
        }

        return redirect()->route('wip_komponen.index');
    }







    /**
     * Update data WIP Komponen.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'komponen_id' => 'required|exists:order_requests,id',
            'mesin_id' => 'required|exists:mesins,id',
            'lokasi' => 'required|string|max:255',
            'tanggal_out' => 'required|date',
            'jumlah_out' => 'required|numeric|min:1',
            'status' => 'nullable|string',
        ]);

        $wip = WipKomponen::findOrFail($id);
        $orderRequest = \App\Models\OrderRequest::findOrFail($request->komponen_id);

        // Hitung total jumlah_out selain yang sedang diedit
        $totalWipOutLain = \App\Models\WipKomponen::where('komponen_id', $request->komponen_id)
            ->where('id', '!=', $wip->id)
            ->sum('jumlah_out');

        $sisa = $orderRequest->jumlah - $totalWipOutLain;

        // Validasi jika jumlah_out baru melebihi sisa
        if ($request->jumlah_out > $sisa) {
            Alert::error('Gagal', 'Jumlah out melebihi jumlah order yang tersedia! Sisa saat ini: ' . $sisa);
            return redirect()->back()->withInput();
        }

        // Update data WIP
        $updated = $wip->update([
            'komponen_id' => $request->komponen_id,
            'mesin_id' => $request->mesin_id,
            'lokasi' => $request->lokasi,
            'tanggal_out' => $request->tanggal_out,
            'jumlah_out' => $request->jumlah_out,
            'status' => $request->status ?? 'Selesai',
        ]);

        // Hitung total jumlah_out setelah update
        $totalWipOutBaru = \App\Models\WipKomponen::where('komponen_id', $request->komponen_id)->sum('jumlah_out');

        // Jika jumlah_out == jumlah, update status OrderRequest jadi "Selesai"
        if ($totalWipOutBaru == $orderRequest->jumlah) {
            $orderRequest->status = 'Selesai';
            $orderRequest->save();
        }

        if ($updated) {
            Alert::success('Sukses', 'Data berhasil diperbarui!');
        } else {
            Alert::error('Gagal', 'Gagal memperbarui data!');
        }

        return redirect()->route('wip_komponen.index');
    }




    /**
     * Hapus data WIP Komponen.
     */
    public function destroy(string $id)
    {
        $wip = WipKomponen::findOrFail($id);
        $deleted = $wip->delete();

        if ($deleted) {
            Alert::success('Sukses', 'Data berhasil dihapus!');
        } else {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus!');
        }

        return redirect()->route('wip_komponen.index');
    }




}
