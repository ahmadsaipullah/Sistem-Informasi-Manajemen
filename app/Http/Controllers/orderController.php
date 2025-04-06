<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Models\User;
use App\Models\OrderRequest;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index()
    {
        $orders = OrderRequest::with(['operator', 'komponen'])->where('status', 'diproses')->get();
        $users = User::all();
        $komponens = Komponen::all(); // Tambahkan untuk dropdown komponen
        return view('pages.operator_transfer_set.order', compact('orders', 'users', 'komponens'));
    }
}
