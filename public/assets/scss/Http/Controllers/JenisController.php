<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jenis;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class JenisController extends Controller
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
        if (Auth::user()->level != 'admin') {
            Alert::error('Ooppss..', 'Anda dilarang masuk halaman ini.');
            return redirect()->to('/');
        }

        $datas = Jenis::get();
        return view('jenis.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level != 'admin') {
            Alert::error('Ooppss..', 'Anda dilarang masuk halaman ini.');
            return redirect()->to('/');
        }

        return view('jenis.create');
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
            'kode_jenis' => 'required|string|max:10|unique:jenis'
        ]);

        Jenis::create($request->all());

        Alert::success('Berhasil', 'Data berhasil ditambahkan.');
        return redirect()->route('jenis.index');
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
        if (Auth::user()->level != 'admin') {
            Alert::error('Ooppss..', 'Anda dilarang masuk halaman ini.');
            return redirect()->to('/');
        }

        $data = Jenis::find($id);
        return view('jenis.edit', compact('data'));
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
        Jenis::find($id)->update($request->all());

        Alert::success('Berhasil', 'Data berhasil diedit.');
        return redirect()->route('jenis.index');
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
