<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Alert::success('Good Job!!!', 'Anda Berhasil Login.')->persistent("Close");
        $data_kategori = DB::table('produks')
            ->select(
                DB::raw('nm_kategori as katego'),
                DB::raw('count(*) as number')
            )
            ->join('kategoris', 'produks.kategoris_id', '=', 'kategoris.id')
            ->groupBy('katego')
            ->get();
        $array[] = ['Kategori', 'Number'];
        foreach ($data_kategori as $key => $value) {
            $array[++$key] = [$value->katego, $value->number];
        }

        $data_pesanan = DB::table('pesanans')
            ->select(
                DB::raw('monthname(created_at) as year'),
                DB::raw('SUM(subtotal) as total_harga'),
                DB::raw('SUM(qty) as total_qty')
            )
            ->orderBy("created_at")
            ->groupBy(DB::raw("monthname(created_at)"))
            ->get();
        $arrayku[] = ['year', 'Total Penjualan', 'Harga'];
        foreach ($data_pesanan as $key => $value) {
            $arrayku[++$key] = [$value->year, (int) $value->total_harga, (int) $value->total_qty];
        }
        return view('home')->with([
            'kategoris_id' => json_encode($array),
            'pesanan_persen' => json_encode($arrayku),
        ]);
    }
}
