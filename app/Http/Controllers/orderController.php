<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mesin;
use App\Models\Komponen;
use App\Models\OrderRequest;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index()
    {
        $orders = OrderRequest::with(['operator', 'komponen'])->where('status', 'diproses')->get();
        $users = User::all();
        $mesins = Mesin::all();
        $komponens = Komponen::all(); // Tambahkan untuk dropdown komponen
        return view('pages.admin.wip_komponen.order', compact('orders', 'users', 'komponens','mesins'));
    }
}
