<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Peminjaman;
use App\User;
use App\Detail_Pinjam;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->level == 'admin') {
            $datas = Peminjaman::get();
        }elseif (Auth::user()->level == 'petugas') {
            $datas = Peminjaman::where('users_id', Auth::user()->id)
                                ->orWhereHas('users', function($e) {
                                $e->where('level', 'peminjam');
                            })->get();
        }else{
            $datas = Peminjaman::where('users_id', Auth::user()->id)->get();
        }
        return view('peminjaman.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $getRow = Peminjaman::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();
        
        $lastId = $getRow->first();

        $kode = "PM00001";
        
        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                    $kode = "PM0000".''.($rowCount + 1);
            } else if ($lastId->id < 99) {
                    $kode = "PM000".''.($rowCount + 1);
            } else if ($lastId->id < 999) {
                    $kode = "PM00".''.($rowCount + 1);
            } else if ($lastId->id < 9999) {
                    $kode = "PM0".''.($rowCount + 1);
            } else {
                    $kode = "PM".''.($rowCount + 1);
            }
        }

        $inventorys = Inventory::where('jumlah', '>', 0)->get();
        if (Auth::user()->level == 'petugas') {
            $users = User::where('level', '!=', 'admin')->get();
        }else {
            $users = User::get();
        }
        return view('peminjaman.create', compact('inventorys', 'users', 'kode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->get('jumlah') > $request->get('jumlah2')) {
            
            Alert::error('Gagal!', 'Jumlah yang dipinjam melebihi stok yang ada!');

            return back();
        }

        $borrow = new Peminjaman;
            $borrow->kode = $request->get('pinjam_id');
            $borrow->tgl_pinjam = $request->get('tgl_pinjam');
            $borrow->tgl_kembali = $request->get('tgl_kembali');
            $borrow->status_peminjaman = $request->get('status');
            $borrow->users_id = $request->get('users_id');
            $borrow->save();

        $detailBorrow = Detail_Pinjam::create([
            'inventaris_id' => $request->get('inventory_id'),
            'jumlah' => $request->get('jumlah'),
            'peminjaman_id' => $borrow->latest()->first()->id,
        ]);

        $inv = Inventory::where('id', $request->get('inventory_id'))->first();
        $updateStok = $inv->update([
            'jumlah' => $inv->jumlah - $request->get('jumlah'),
        ]);

        Alert::success('Berhasil', 'Transaksi Peminjaman Berhasil Dibuat.');
        return redirect()->route('borrow.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateStatus = Peminjaman::find($id)->update([
            'status_peminjaman' => 'Dikembalikan',
        ]);
        
        $idInv = Detail_Pinjam::where('peminjaman_id', $id)->first();
        $stok = Inventory::where('id', $idInv->inventaris_id)->first();
        $stok->update([
            'jumlah' => $stok->jumlah + $idInv->jumlah,
        ]);

        Alert::success('Berhasil', 'Transaksi Peminjaman Barang Berhasil Dikembalikan.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
