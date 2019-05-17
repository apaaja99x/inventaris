@extends('layouts.app')

@section('content')

@section('css')

<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css')}}">

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


  <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

 <script type="text/javascript">
   $(document).on('click', '.pilih', function (e) {
                document.getElementById("buku_judul").value = $(this).attr('data-buku_judul');
                document.getElementById("buku_id").value = $(this).attr('data-buku_id');
                document.getElementById("jumlah").value = $(this).attr('data-jumlah');
                $('#myModal').modal('hide');
            });

            $(document).on('click', '.pilih_anggota', function (e) {
                document.getElementById("anggota_id").value = $(this).attr('data-anggota_id');
                document.getElementById("anggota_nama").value = $(this).attr('data-anggota_nama');
                $('#myModal2').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });

</script>

@stop

<div class="container-fluid">
	
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Tambah Jenis Barang Inventaris</h1>
	  </div>
	  <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	  tempor incididunt ut labore et dolore magna aliqua.</p>
	<div class="card mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
			Isi Data Jenis Barang</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-3">
					<label class="form-label">Kode Peminjaman</label><br>
					<label class="form-label plus">Tgl Peminjaman</label><br>
					<label class="form-label plus">Tgl Pengembalian</label><br>
					<label class="form-label plus">Status</label><br>
					<label class="form-label plus">Pilih Barang</label><br>
					<label class="form-label plus">Jumlah</label><br>
					<label class="form-label plus">Pilih Pengguna</label><br>
				</div>
				<div class="col-6">
					<form action="{{ route('borrow.store') }}" method="POST" class="user">
						{{csrf_field()}}
						<div class="form-group">
							<input type="text" value="{{$kode}}" class="form-control form-control-user" name="pinjam_id" required="" readonly=""></input>	
						</div>
						<div class="form-group">
							<input type="date" class="form-control form-control-user" name="tgl_pinjam" required="" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString())) }}" required></input>
						</div>
						<div class="form-group">
							<input type="date" class="form-control form-control-user" name="tgl_kembali" required="" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(7)->toDateString())) }}" required></input>
						</div>
						<div class="form-group">
							<select class="form-control form-control-user" name="status" style="padding: 10px;height: 50px;" required="">
		                      <option selected="">Pinjam</option>
		                      <option disabled="">Kembali</option>
		                    </select>
						</div>
						<div class="form-group{{ $errors->has('inventory_id') ? ' has-error' : '' }}">
                            <div class="input-group">
                            <input id="buku_judul" type="text" class="form-control form-control-user" readonly="" required>
                            <input id="jumlah" type="hidden" readonly="" required name="jumlah2">
                            <input id="buku_id" type="hidden" name="inventory_id" value="{{ old('inventory_id') }}" required readonly="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><b style="font-size: 15px;">Cari Barang</b> <span class="fa fa-search"></span></button>
                            </span>
                            </div>
                            @if ($errors->has('inventory_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('inventory_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
							<input type="number" id="jumlah2" class="form-control form-control-user" name="jumlah" placeholder="Jumlah Barang" required=""></input>	
						</div>
                        @if(Auth::user()->level != 'peminjam')
                        <div class="form-group{{ $errors->has('users_id') ? ' has-error' : '' }}">
                            <div class="input-group">
                            <input id="anggota_nama" type="text" class="form-control form-control-user" readonly="" required>
                            <input id="anggota_id" type="hidden" name="users_id" value="{{ old('users_id') }}" required readonly="">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal2"><b style="font-size: 15px">Cari Pengguna</b> <span class="fa fa-search"></span></button>
                            </span>
                            </div>
                            @if ($errors->has('users_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('users_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        @else
                        <div class="form-group{{ $errors->has('users_id') ? ' has-error' : '' }}">
                            <input id="anggota_nama" type="text" class="form-control form-control-user" readonly="" value="{{Auth::user()->nama_petugas}}" required>
                            <input id="anggota_id" type="hidden" name="users_id" value="{{ Auth::user()->id }}" required readonly="">
                          
                            @if ($errors->has('users_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('users_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        @endif
						<br><br>
						<button class="btn btn-success btn-icon-split btn-lg" style="float: right;margin-bottom: 100px;"><span class="icon text-white-50"><i class="fas fa-check"></i></span>
							<span class="text">Buat Transaksi</span>
						</button>
					</form>	
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Barang -->

<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kondisi</th>
                                    <th>Jumlah</th>
                                    <th>Jenis</th>
                                    <th>Ruang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventorys as $data)
                                <tr class="pilih" data-buku_id="<?php echo $data->id; ?>" data-buku_judul="<?php echo $data->nama; ?>" data-jumlah="<?php echo $data->jumlah; ?>">
                                    <td>{{$data->nama}}</td>
                                    <td>{{$data->kondisi}}</td>
                                    <td>{{$data->jumlah}}</td>
                                    <td>{{$data->jenis->nama_jenis}}</td>
                                    <td>{{$data->ruang->nama_ruang}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pengguna -->

<div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="lookup" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $data)
                <tr class="pilih_anggota" data-anggota_id="<?php echo $data->id; ?>" data-anggota_nama="<?php echo $data->nama_petugas; ?>" >
                    <td>{{$data->nama_petugas}}</td>
                	<td>{{$data->username}}</td>
                	<td>{{$data->level}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>  
            </div>
        </div>
    </div>
</div>

@endsection