@extends('layouts.app')

@section('content')

@section('css')

<style type="text/css">
  .form-label{
    margin: 10px;
      font-weight: bold;
  }
  .plus{
    margin-top: 33px;
  }
</style>

@stop

<div class="container-fluid">
  
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>
    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua.</p>
  <div class="card mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
      Edit Data User</h6>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-2">
          <label class="form-label">Nama</label><br>
          <label class="form-label plus">Username</label><br>
          <label class="form-label plus">Level</label><br>
        </div>
        <div class="col-6">
          <form action="{{ route('ruang.update', $data->id) }}" method="POST" class="user">
            {{method_field('put')}}
            {{csrf_field()}}
            <div class="form-group">
              <input type="text" value="{{$data->nama_petugas}}" placeholder="Nama User" class="form-control form-control-user" name="nama_ruang" required=""></input> 
            </div>
            <div class="form-group">
              <input type="text" value="{{$data->username}}" placeholder="Kode Jenis" class="form-control form-control-user" name="kode_ruang" required=""></input> 
            </div>
            <div class="form-group">
              <input type="text" value="{{$data->level}}" placeholder="Kode Jenis" class="form-control form-control-user" name="kode_ruang" required=""></input> 
            </div>
            <br><br>
            <button class="btn btn-warning btn-icon-split btn-lg" style="float: right;margin-bottom: 100px;"><span class="icon text-white-50"><i class="fas fa-exclamation-triangle"></i></span>
              <span class="text">Edit</span>
            </button>
          </form> 
        </div>
      </div>
    </div>
  </div>
</div>

@endsection