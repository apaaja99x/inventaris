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
              <h6 class="m-0 font-weight-bold text-primary" style="float: left">Data Inventory</h6>
              <a href="{{ route('inventory.create') }}" class="btn btn-success btn-icon-split btn-md" style="float: right;">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Tambah Barang</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Inventaris</th>
                      <th>Gambar</th>
                      <th>Nama</th>
                      <th>Kondisi</th>
                      <th>Keterangan</th>
                      <th>Jumlah</th>
                      <th>Jenis</th>
                      <th>Tgl Register</th>
                      <th>Ruang</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($datas as $data)
                    <tr>
                      <td>{{$data->kode_inventaris}}</td>
                      <td><img src="{{asset('assets/img/'. $data->gambar)}}" style="width: 50px;height: 50px;"></td>
                      <td>{{$data->nama}}</td>
                      <td>{{$data->kondisi}}</td>
                      <td>{{str_limit($data->keterangan,20)}}</td>
                      <td>{{$data->jumlah}}</td>
                      <td>{{$data->jenis->nama_jenis}}</td>
                      <td>{{$data->tanggal_register->format('d-m-Y')}}</td>
                      <td>{{$data->ruang->nama_ruang}}</td>
                      <td style="display: -webkit-inline-box"><a href="{{ route('inventory.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      	<form action="{{ route('inventory.destroy', $data->id) }}" method="POST" style="margin-left: 2px;">
                      		{{csrf_field()}}
                      		{{method_field('delete')}}
                      	<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-times"></i></button>
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