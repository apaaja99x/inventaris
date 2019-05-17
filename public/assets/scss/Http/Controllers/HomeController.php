<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
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
        $pinjam = Peminjaman::get();
        if (Auth::user()->level == 'petugas') {
            $datas = Peminjaman::where('status_peminjaman', 'Pinjam')
                            ->where('users_id', Auth::user()->id)
                            ->orWhereHas('users', function($e) {
                                $e->where('level', 'peminjam');
                            })->where('status_peminjaman', 'Pinjam')->get();
        }elseif (Auth::user()->level == 'peminjam') {
            $datas = Peminjaman::where('status_peminjaman', 'Pinjam')
                            ->where('users_id', Auth::user()->id)->get();
        }else{
            $datas = Peminjaman::where('status_peminjaman', 'Pinjam')->get();
        }
        return view('home', compact('datas'));
    }
}
