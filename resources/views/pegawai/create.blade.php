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
	    <h1 class="h3 mb-0 text-gray-800">Tambah Pegawai</h1>
	  </div>
	  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	  tempor incididunt ut labore et dolore magna aliqua.</p>
	<div class="card mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
			Isi Pegawai</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-2">
					<label class="form-label">Nama Pegawai</label><br>
					<label class="form-label plus">NIP</label><br>
					<label class="form-label plus">Alamat</label><br>
				</div>
				<div class="col-6">
					<form action="{{ route('pegawai.store') }}" method="POST" class="user">
						{{csrf_field()}}
						<div class="form-group{{ $errors->has('nama_pegawai') ? ' has-error' : '' }}">
							<input type="text" placeholder="Nama Pegawai" value="{{ old('nama_pegawai') }}" class="form-control form-control-user" name="nama_pegawai" required=""></input>	
							@if ($errors->has('nama_pegawai'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama_pegawai') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group{{ $errors->has('npm') ? ' has-error' : '' }}">
							<input type="text" placeholder="NIP" value="{{ old('nip') }}" class="form-control form-control-user" name="nip" required=""></input>
							@if ($errors->has('nip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nip') }}</strong>
                                </span>
                            @endif	
						</div>
						<div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
							<textarea placeholder="Alamat" class="form-control form-control-user" name="alamat" required="">{{ old('alamat') }}</textarea>
							@if ($errors->has('alamat'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alamat') }}</strong>
                                </span>
                            @endif
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