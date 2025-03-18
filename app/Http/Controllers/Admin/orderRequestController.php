<?php

namespace App\Http\Controllers\Admin;

use App\Models\OrderRequest;
use App\Models\User;
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
        $orders = OrderRequest::with('operator')->get();
        $users = User::all();
        return view('pages.admin.order_requests.index', compact('orders','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => ['required', 'date'],
            'kode_product' => ['required', 'string', 'unique:order_requests'],
            'operator_id' => ['required', 'exists:users,id'],
            'nama_komponen' => ['required', 'string'],
            'jumlah' => ['required', 'integer'],
            'jenis_komponen' => ['required', 'string'],

        ]);

        $order = OrderRequest::create($request->all());

        if ($order) {
            Alert::success('Sukses', 'Data berhasil ditambah!');
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
            'tanggal' => ['required', 'date'],
            'kode_product' => ['required', 'string', 'unique:order_requests,kode_product,' . $id],
            'operator_id' => ['required', 'exists:users,id'],
            'nama_komponen' => ['required', 'string'],
            'jumlah' => ['required', 'integer'],
            'jenis_komponen' => ['required', 'string'],
            'status' => ['required', 'string'],
        ]);

        $order = OrderRequest::findOrFail($id);
        $updated = $order->update($request->all());

        if ($updated) {
            Alert::success('Sukses', 'Data berhasil diupdate!');
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
