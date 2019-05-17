<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruang;
use Auth;

class RuangController extends Controller
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
        if(Auth::user()->level != 'admin'){
            return redirect()->to('/');
        }

        $datas = Ruang::get();
        return view('ruang.index', compact('datas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->level != 'admin'){
            return redirect()->to('/');
        }

        return view('ruang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Ruang::create($request->all());
        alert()->success('Berhasil', 'Data telah ditambahkan.');

        return redirect()->route('ruang.index');
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
        if(Auth::user()->level != 'admin'){
            return redirect()->to('/');
        }

        $data = Ruang::find($id);
        return view('ruang.edit', compact('data'));
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
        Ruang::find($id)->update($request->all());
        alert()->success('Berhasil', 'Data telah berhasil diedit.');
        return redirect()->route('ruang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ruang::find($id)->delete();
        alert()->success('Berhasil', 'Data telah berhasil dihapus.');

        return redirect()->route('jenis.index');
    }
}
