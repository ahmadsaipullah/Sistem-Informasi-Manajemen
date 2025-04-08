<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\WipKomponen;
use App\Models\OrderRequest;
use App\Models\HasilProduksi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class dashboardController extends Controller
{
    public function index()
    {
        // Ambil semua order dengan relasi operator & komponen
        $orders = OrderRequest::with(['operator', 'komponen'])->get();

        // Hitung jumlah berdasarkan status
        $countPending = $orders->where('status', 'pending')->count();
        $countDiproses = $orders->where('status', 'diproses')->count();
        $countSelesai = $orders->where('status', 'Selesai')->count();

        // Hitung total user
        $user = User::count();

        // Ambil semua produksi_id yang sudah masuk ke hasil produksis
        $sudahInputIds = HasilProduksi::pluck('produksi_id')->toArray();

        // Ambil semua wip_komponen dan hasil produksinya
        $wip_komponens = WipKomponen::with(['orderRequest', 'mesin'])->get();

        // Hitung dan ambil data yang belum terinput
        $wipBelumInput = $wip_komponens->whereNotIn('id', $sudahInputIds);
        $belumInputCount = $wipBelumInput->count();

        // Ambil semua data hasil produksi
        $hasilProduksis = HasilProduksi::with('produksi')->latest()->get();

        return view('pages.dashboard', compact(
            'user',
            'belumInputCount',
            'wipBelumInput',
            'hasilProduksis',
            'countPending',
            'countDiproses',
            'countSelesai'
        ));
    }




}
