<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Peminjaman;
use App\User;
use App\Detail_Pinjam;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tBarang = Inventory::count();
        if (Auth::user()->level == 'petugas') {
            $datas = Peminjaman::where('status_peminjaman', 'Pinjam')
                            ->where('users_id', Auth::user()->id)
                            ->orWhereHas('users', function($e) {
                                $e->where('level', 'peminjam');
                            })->where('status_peminjaman', 'Pinjam')->get();
            $tTrans = $datas->count();
            $tPinjam = Peminjaman::where('status_peminjaman', 'Dikembalikan')
                            ->where('users_id', Auth::user()->id)
                            ->orWhereHas('users', function($e) {
                                $e->where('level', 'peminjam');
                            })->where('status_peminjaman', 'Dikembalikan')->count();

        }elseif (Auth::user()->level == 'peminjam') {
            $datas = Peminjaman::where('status_peminjaman', 'Pinjam')
                            ->where('users_id', Auth::user()->id)->get();
            $tTrans = Peminjaman::where('users_id', Auth::user()->id)->count();
            $tPinjam = $datas->count();

        }else{
            $datas = Peminjaman::where('status_peminjaman', 'Pinjam')->get();
            $tTrans = Peminjaman::count();
            $tPinjam = Peminjaman::where('status_peminjaman', 'Pinjam')->count();
            $tUser = User::count();
        }
        return view('home', compact('datas', 'tBarang', 'tTrans', 'tPinjam', 'tUser'));
    }
}
