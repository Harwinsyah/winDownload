<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Film;
use App\Order;
use App\Pelanggan;
use App\Penyimpanan;
use App\Situs;
use App\Accounting;

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
        $now = \Carbon\Carbon::now();
        // $penjualanDetail = Order::where('tgl', $tahun)->count();

        $film = Film::count('id');
        $order = Order::where('status', '!=', 5)->count();
        $pelanggan = Pelanggan::count('id');
        $penyimpanan = Penyimpanan::count('id');
        $update = Film::where('status', '=', 'Belum Ready')->orderBy('ket', 'asc')->paginate(10);
        $situsfilm = Situs::all()->where('jenis', 'like', 'Film');
        $situsanime = Situs::all()->where('jenis', 'like', 'Anime');
        $situskorea = Situs::all()->where('jenis', 'like', 'Drama Korea');
        $situsgame = Situs::all()->where('jenis', 'like', 'Game');
        $situsapp = Situs::all()->where('jenis', 'like', 'Aplikasi');
        $pemasukanhari = Accounting::whereDate('tgl', $now)->sum('pemasukan');
        $pemasukanbulan = Accounting::whereMonth('tgl', $now)->sum('pemasukan');
        $pengeluaranbulan = Accounting::whereMonth('tgl', $now)->sum('pengeluaran');        

        return view('home', compact(['film', 'pelanggan', 'order', 'penyimpanan', 'situsfilm', 'situsgame', 'situsapp', 'situsanime', 'situskorea', 'update', 'pemasukanbulan', 'pemasukanhari', 'pengeluaranbulan']));
    }

}
