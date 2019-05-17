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
	    <h1 class="h3 mb-0 text-gray-800">Edit Ruang Inventaris</h1>
	  </div>
	  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	  tempor incididunt ut labore et dolore magna aliqua.</p>
	<div class="card mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
			Edit Data Ruang</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-2">
					<label class="form-label">Nama Pegawai</label><br>
					<label class="form-label plus">NIP</label><br>
					<label class="form-label plus">Alamat</label><br>
				</div>
				<div class="col-6">
					<form action="{{ route('pegawai.update', $data->id) }}" method="POST" class="user">
						{{method_field('put')}}
						{{csrf_field()}}
						<div class="form-group">
							<input type="text" value="{{$data->nama_pegawai}}" placeholder="Nama" class="form-control form-control-user" name="nama_pegawai" required=""></input>	
						</div>
						<div class="form-group">
							<input type="text" value="{{$data->nip}}" placeholder="Username" class="form-control form-control-user" name="nip" required=""></input>	
						</div>
						<div class="form-group">
							<textarea placeholder="Alamat" class="form-control form-control-user" name="alamat" required="">{{$data->alamat}}</textarea>
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