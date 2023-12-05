<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=[
            'dailyRevenues' => Nota::whereDate('created_at', Carbon::today())->sum('total_harga'),

            'allTimeRevenues' => Nota::sum('total_harga'),

            'groupedDaily' =>Nota::selectRaw('DATE(created_at) day, SUM(total_harga) total')->groupBy('day')->get(),

            'dailyProducts' => Cart::whereDate('created_at', Carbon::today())->sum('jumlah'),

            'allTimeProducts' => Cart::sum('jumlah'),

            'topFiveProducts' => Cart::select(
                DB::raw('SUM(jumlah) as jumlah_buku'),
                'dasarBuku.judul as judul')
            ->join('dasarBuku', 'cart.id_buku', '=', 'dasarBuku.id_buku')
            ->groupBy('cart.id_buku', 'dasarBuku.judul')
            ->orderByRaw('jumlah_buku DESC')
            ->take(5)
            ->get(),
        ];

        return view('backend.dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
