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
	    <h1 class="h3 mb-0 text-gray-800">Tambah Ruang Inventaris</h1>
	  </div>
	  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	  tempor incididunt ut labore et dolore magna aliqua.</p>
	<div class="card mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
			Isi Data Ruang</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-2">
					<label class="form-label">Nama Ruang</label><br>
					<label class="form-label plus">Kode Ruang</label><br>
					<label class="form-label plus">Keterangan</label><br>
				</div>
				<div class="col-6">
					<form action="{{ route('ruang.store') }}" method="POST" class="user">
						{{csrf_field()}}
						<div class="form-group">
							<input type="text" placeholder="Nama Ruang" class="form-control form-control-user" name="nama_ruang" required=""></input>	
						</div>
						<div class="form-group">
							<input type="text" placeholder="Kode Ruang" class="form-control form-control-user" name="kode_ruang" required=""></input>	
						</div>
						<div class="form-group">
							<textarea placeholder="Keterangan Ruang" class="form-control form-control-user" name="keterangan" required=""></textarea>
						</div>
						<br><br>
						<button class="btn btn-success btn-icon-split btn-lg" style="float: right;margin-bottom: 100px;"><span class="icon text-white-50"><i class="fas fa-check"></i></span>
							<span class="text">Simpan</span>
						</button>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

@endsection