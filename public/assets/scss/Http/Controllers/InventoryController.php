<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Ruang;
use App\Jenis;
use App\User;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class InventoryController extends Controller
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
        if (Auth::user()) {
            if (Auth::user()->level == 'admin') {
                $datas = Inventory::get();

                return view('inventory.index', compact('datas'));
            }else{
                return view('home');
            }
        }else{
            return redirect()->to('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jeniss = Jenis::get();
        $ruangs = Ruang::get();
        $users = User::get();

        return view('inventory.create', compact('jeniss', 'ruangs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_inventaris' => 'required|string|max:10|unique:inventaris'
        ]);

        Inventory::create($request->all());

        alert()->success('Berhasil', 'Data telah ditambahkan.');
        return redirect()->route('inventory.index');
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
        if (Auth::user()->level == 'admin') {
            $jeniss = Jenis::get();
            $ruangs = Ruang::get();
            $users = User::get();
            $data = Inventory::where('id', $id)->first();

            return view('inventory.edit', compact('data', 'jeniss', 'ruangs', 'users'));
        }else{
            return view('home');
        }
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
        Inventory::find($id)->update($request->all());

        alert()->success('Berhasil', 'Data sukses diedit.');
        return redirect()->route('inventory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Inventory::find($id)->delete();

        Alert::success('Berhasil Dihapus', 'Data telah terhapus');
        return redirect()->route('inventory.index');
    }
}
