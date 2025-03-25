<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderRequest;
use App\Models\User;
use App\Models\Komponen;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class OrderRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = OrderRequest::with(['operator', 'komponen'])->get();
        $users = User::all();
        $komponens = Komponen::all(); // Tambahkan untuk dropdown komponen
        return view('pages.admin.order_requests.index', compact('orders', 'users', 'komponens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_komponen_id' => ['required', 'exists:komponens,id'],
            'operator_id' => ['required', 'exists:users,id'],
            'jumlah' => ['required', 'integer'],
            'jenis_komponen' => ['required', 'string'],
        ]);

        // Ambil data komponen berdasarkan ID
        $komponen = Komponen::findOrFail($request->kode_komponen_id);

        // Cek apakah stok mencukupi
        if ($request->jumlah > $komponen->stok) {
            Alert::warning('Peringatan', 'Stok tidak mencukupi!');
            return redirect()->back()->withInput();
        }

        // Jika stok cukup, buat order
        $order = OrderRequest::create($request->all());

        if ($order) {
            // Kurangi stok di tabel komponens
            $komponen->stok -= $request->jumlah;
            $komponen->save();

            Alert::success('Sukses', 'Data berhasil ditambah dan stok telah diperbarui!');
        } else {
            Alert::error('Gagal', 'Data gagal ditambahkan!');
        }

        return redirect()->route('order_requests.index');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_komponen_id' => ['required', 'exists:komponens,id'],
            'operator_id' => ['required', 'exists:users,id'],
            'jumlah' => ['required', 'integer'],
            'jenis_komponen' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        $order = OrderRequest::findOrFail($id);
        $komponen = Komponen::findOrFail($order->kode_komponen_id);

        // Hitung selisih jumlah sebelum dan setelah update
        $jumlah_lama = $order->jumlah;
        $jumlah_baru = $request->jumlah;
        $selisih = $jumlah_baru - $jumlah_lama;

        // Jika jumlah bertambah, pastikan stok mencukupi
        if ($selisih > 0 && $selisih > $komponen->stok) {
            Alert::warning('Peringatan', 'Stok tidak mencukupi untuk perubahan ini!');
            return redirect()->back()->withInput();
        }

        // Perbarui stok berdasarkan perubahan jumlah
        $komponen->stok -= $selisih;
        $komponen->save();

        // Update data order
        $updated = $order->update($request->all());

        if ($updated) {
            Alert::success('Sukses', 'Data berhasil diupdate dan stok telah diperbarui!');
        } else {
            Alert::error('Gagal', 'Data gagal diupdate!');
        }

        return redirect()->route('order_requests.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = OrderRequest::findOrFail($id);
        $deleted = $order->delete();

        if ($deleted) {
            Alert::success('Sukses', 'Data berhasil dihapus!');
        } else {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data!');
        }

        return redirect()->route('order_requests.index');
    }
}
