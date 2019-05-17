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

@section('js')

<script type="text/javascript">
	function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
</script>

@stop

<div class="container-fluid">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Tambah Barang Inventaris</h1>
	  </div>
	  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	  tempor incididunt ut labore et dolore magna aliqua.</p>
	<div class="card mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
			Isi Data Barang</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-2">
					<label class="form-label">Nama Barang</label><br>
					<label class="form-label plus">Kondisi</label><br>
					<label class="form-label plus">Keterangan</label><br>
					<label class="form-label plus" style="margin-top: 65px;">Jumlah</label><br>
					<label class="form-label plus">Jenis</label><br>
					<label class="form-label plus">Tgl Register</label><br>
					<label class="form-label plus">Ruang</label><br>
					<label class="form-label plus">Kode Inventaris</label><br>
					<label class="form-label plus">Nama User</label><br>
					<label class="form-label plus">Gambar</label><br>
				</div>
				<div class="col-6">
					<form action="{{ route('inventory.store') }}" method="POST" class="user" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="form-group">
							<input type="text" placeholder="Nama Barang" class="form-control form-control-user" name="nama" required=""></input>	
						</div>
						<div class="form-group">
							<input type="text" placeholder="Kondisi Barang" class="form-control form-control-user" name="kondisi" required=""></input>	
						</div>
						<div class="form-group">
							<textarea placeholder="Keterangan Barang" class="form-control form-control-user" name="keterangan" required=""></textarea>
						</div>
						<div class="form-group">
							<input type="text" placeholder="Jumlah Barang" class="form-control form-control-user" name="jumlah" required=""></input>	
						</div>
						<div class="form-group">
		                    <select class="form-control form-control-user" name="jenis_id" style="padding: 10px;height: 50px;" required="">
		                      <option selected="" disabled="">--Pilih Jenis--</option>
		                      @foreach($jeniss as $jenis)
		                      <option value="{{$jenis->id}}">{{$jenis->nama_jenis}}</option>
		                      @endforeach
		                    </select>
		                </div>
						<div class="form-group">
							<input type="date" placeholder="Tanggal Register" class="form-control form-control-user" name="tanggal_register" required="" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}"></input>	
						</div>
						<div class="form-group">
							<select class="form-control form-control-user" name="ruang_id" style="padding: 10px;height: 50px;" required="">
		                      <option selected="" disabled="">--Pilih Ruang--</option>
		                      @foreach($ruangs as $ruang)
		                      <option value="{{$ruang->id}}">{{$ruang->nama_ruang}}</option>
		                      @endforeach
		                    </select>
						</div>
						<div class="form-group{{ $errors->has('kode_inventaris') ? ' has-error' : '' }}">
							<input type="text" placeholder="Kode Inventaris Barang" class="form-control form-control-user" name="kode_inventaris" value="{{ old('kode_inventaris') }}" required=""></input>	
							@if ($errors->has('kode_inventaris'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('kode_inventaris') }}</strong>
                                </span>
                            @endif
						</div>
						<div class="form-group">
							<select class="form-control form-control-user" name="users_id" style="padding: 10px;height: 50px;" required="">
		                      <option selected="" disabled="">--Pilih Users--</option>
		                      @foreach($users as $user)
		                      <option value="{{$user->id}}">{{$user->nama_petugas}}</option>
		                      @endforeach
		                    </select>
						</div>
						<div class="form-group">
							<img width="200" height="200" />
                                <input type="file" class="uploads form-control" style="margin-top: 20px;" name="gambar">
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