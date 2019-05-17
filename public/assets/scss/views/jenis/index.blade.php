@extends('layouts.app')

@section('content')

@section('css')

<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@stop

<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Inventaris</h1>
          <p class="mb-4">Menampilkan seluruh data yang tersimpan di database inventaris.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" style="float: left">Data Jenis</h6>
              <a href="{{ route('jenis.create') }}" class="btn btn-primary btn-icon-split btn-md" style="float: right;">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Tambah Jenis Barang</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Jenis</th>
                      <th>Kode Jenis</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($datas as $index => $data)
                    <tr>
                      <td>{{$index +1}}</td>
                      <td>{{$data->nama_jenis}}</td>
                      <td>{{$data->kode_jenis}}</td>
                      <td>{{str_limit($data->keterangan,50)}}</td>
                      <td><a href="{{ route('jenis.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      	<form action="{{ route('jenis.destroy', $data->id) }}" method="POST">
                      		{{csrf_field()}}
                      		{{method_field('delete')}}
                      	<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                      </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>

@section('js')

<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
<script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>

@stop

@endsection