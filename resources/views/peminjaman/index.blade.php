@extends('layouts.app')

@section('content')

@section('css')

<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@stop

<div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Transaksi Peminjaman</h1>
          <p class="mb-4">Menampilkan data transaksi di akun ini.</p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary" style="float: left">Data Peminjaman</h6>
              <a href="{{ route('borrow.create') }}" class="btn btn-primary btn-icon-split btn-md" style="float: right;">
                    <span class="icon text-white-50">
                      <i class="fas fa-flag"></i>
                    </span>
                    <span class="text">Tambah Transaksi</span>
                  </a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Kode Transaksi</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Tgl Pinjam</th>
                      <th>Tgl Kembali</th>
                      <th>Status</th>
                      <th>Peminjam</th>
                      <th>Level</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($datas as $index => $data)
                    <tr>
                      <td>{{$data->kode}}</td>
                      <td>{{$data->detail_pinjam->inventory->nama}}</td>
                      <td>{{$data->detail_pinjam->jumlah}}</td>
                      <td>{{$data->tgl_pinjam->format('d-m-Y')}}</td>
                      <td>{{$data->tgl_kembali->format('d-m-Y')}}</td>
                      <td><a class="btn btn-{{($data->status_peminjaman == 'Pinjam') ? 'warning' : 'success'}} btn-sm" style="color: white;">{{$data->status_peminjaman}}</a></td>
                      <td>{{$data->users->nama_petugas}}</td>
                      <td>{{$data->users->level}}</td>
                      <td style="display: -webkit-inline-box">
                          @if($data->status_peminjaman == 'Pinjam')
                            <form action="{{ route('borrow.update', $data->id) }}" method="POST">
                                {{csrf_field()}}
                                {{method_field('put')}}
                            <button class="btn btn-info btn-sm" onclick="return confirm('Anda yakin ingin mengembalikan transaksi ini?')"><i class="fas fa-arrow-left"></i> Kembalikan</button>
                            </form>
                          @endif
                        @if(Auth::user()->level == 'admin' && $data->status_peminjaman == 'Dikembalikan')
                      	<form action="{{ route('borrow.destroy', $data->id) }}" method="POST" style="margin-left: 2px;">
                      		{{csrf_field()}}
                      		{{method_field('delete')}}
                      	<button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-times"></i> Hapus</button>
                        @endif
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