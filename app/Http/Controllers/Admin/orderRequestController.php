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
            'tanggal_dedline' => ['required', 'date'],

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
            'tanggal_dedline' => ['required', 'date'],

        ]);

        $order = OrderRequest::findOrFail($id);
        $jumlah_lama = $order->jumlah;
        $jumlah_baru = $request->jumlah;

        $komponen_lama = Komponen::findOrFail($order->kode_komponen_id);
        $komponen_baru = Komponen::findOrFail($request->kode_komponen_id);

        if ($request->kode_komponen_id != $order->kode_komponen_id) {
            // 1. Kembalikan stok lama
            $komponen_lama->stok += $jumlah_lama;
            $komponen_lama->save();

            // 2. Cek stok baru
            if ($jumlah_baru > $komponen_baru->stok) {
                Alert::warning('Peringatan', 'Stok tidak mencukupi untuk komponen baru!');
                return redirect()->back()->withInput();
            }

            // 3. Kurangi stok baru
            $komponen_baru->stok -= $jumlah_baru;
            $komponen_baru->save();
        } else {
            // Komponen tidak berubah, cukup update selisih
            $selisih = $jumlah_baru - $jumlah_lama;

            if ($selisih > 0 && $selisih > $komponen_lama->stok) {
                Alert::warning('Peringatan', 'Stok tidak mencukupi untuk perubahan jumlah!');
                return redirect()->back()->withInput();
            }

            $komponen_lama->stok -= $selisih;
            $komponen_lama->save();
        }

        // Update data order
        $updated = $order->update($request->all());

        if ($updated) {
            Alert::success('Sukses', 'Data berhasil diupdate dan stok diperbarui!');
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



    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|in:pending,selesai,diproses',
    ]);

    $order = OrderRequest::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return response()->json([
        'success' => true,
        'message' => 'Status berhasil diupdate!'
    ]);
}

}
