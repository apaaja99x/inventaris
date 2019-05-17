@extends('layouts.app')

@section('content')

@section('css')

<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@stop

<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Users</h1>
          <p class="mb-4">Menampilkan seluruh data yang tersimpan di database inventaris.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" style="float: left">Data Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Level</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($datas as $index => $data)
                    <tr>
                      <td>{{$index +1}}</td>
                      <td>{{$data->nama_petugas}}</td>
                      <td>{{$data->username}}</td>
                      <td>{{$data->level}}</td>
                      <td style="display: -webkit-inline-box"><a href="{{ route('users.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      	<form action="{{ route('users.destroy', $data->id) }}" method="POST" style="margin-left: 2px;">
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