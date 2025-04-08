<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mesin;
use App\Models\Komponen;
use App\Models\WipKomponen;
use App\Models\OrderRequest;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index()
    {
        $orders = OrderRequest::with(['operator', 'komponen'])
        ->whereIn('status', ['diproses', 'Selesai'])
        ->get();
        $users = User::all();
        $mesins = Mesin::all();
        $komponens = Komponen::all(); // Tambahkan untuk dropdown komponen
        return view('pages.admin.wip_komponen.order', compact('orders', 'users', 'komponens','mesins'));
    }


    public function wip()
    {
        $wip_komponens = WipKomponen::with(['orderRequest', 'mesin'])->get();
        $mesins = Mesin::all();
        $order_requests = OrderRequest::all();

        return view('pages.admin.hasil-produksi.hasilproduksi', compact('wip_komponens', 'mesins', 'order_requests'));
    }
}
