@extends('layouts.app')

@section('content')

@section('css')

<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@stop

<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4" style="text-align: center;">
            <h1 class="h3 mb-0 text-gray-800">Generate Report</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

          	<div class="col-lg-6">
	            <div class="card mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary"><center>Laporan Transaksi Peminjaman</center></h6>
	                </div>
	                <div class="card-body">
	                  <div class="dropdown no-arrow mb-4" style="float: left;margin-left: 80px;">
	                    <button class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                      <i class="fas fa-download fa-sm text-white-50"></i> Export PDF
	                    </button>
	                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	                      <a class="dropdown-item" href="{{url('laporan/trs/pdf')}}">Semua Transaksi</a>
	                      <a class="dropdown-item" href="{{url('laporan/trs/pdf?status=pinjam')}}">Pinjam</a>
	                      <a class="dropdown-item" href="{{url('laporan/trs/pdf?status=kembali')}}">Kembali</a>
	                    </div>
                	  </div>
                	  <div class="dropdown no-arrow mb-4" style="float: right;margin-right: 80px;">
	                    <button class="d-none d-sm-inline-block btn btn-lg btn-success shadow-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                      <i class="fas fa-download fa-sm text-white-50"></i> Export Excel
	                    </button>
	                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	                      <a class="dropdown-item" href="{{url('laporan/trs/excel')}}">Semua Transaksi</a>
	                      <a class="dropdown-item" href="{{url('laporan/trs/excel?status=pinjam')}}">Pinjam</a>
	                      <a class="dropdown-item" href="{{url('laporan/trs/excel?status=kembali')}}">Kembali</a>
	                    </div>
                	  </div>
	                </div>
	              </div>
			</div>

			<div class="col-lg-6">
	            <div class="card mb-4">
	                <div class="card-header py-3">
	                  <h6 class="m-0 font-weight-bold text-primary"><center>Laporan Barang</center></h6>
	                </div>
	                <div class="card-body" style="margin-bottom: 24px;">
	                 <a href="{{url('laporan/barang/pdf')}}" style="float: left;margin-left: 80px;" class="d-none d-sm-inline-block btn btn-lg btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export PDF</a>
	                 <a href="{{url('laporan/barang/excel')}}" style="float: right;margin-right: 80px;" class="d-none d-sm-inline-block btn btn-lg btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export Excel</a>
	                </div>
	              </div>
			</div>
        </div>
        <!-- /.container-fluid -->

      </div>

@section('js')

<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
<script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>

@stop

@endsection


				