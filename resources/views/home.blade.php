@extends('layouts.app')

@section('content')

@section('css')

<link href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@stop

<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            @if(Auth::user()->level == 'admin')
            <a href="{{url('laporan/trs')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            @endif
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary border-bottom-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{(Auth::user()->level == 'admin') ? 'Total Barang' : 'Jumlah Seluruh Barang'}}</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tBarang}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success border-bottom-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Peminjaman</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tTrans}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger border-bottom-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Belum Kembali</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$tPinjam}}</div>
                        </div>
                        <!-- <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div> -->
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @if(Auth::user()->level == 'admin')
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning border-bottom-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Anggota</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$tUser}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>


          <!-- Content Row -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="h5 m-0 font-weight-bold text-primary" style="float: left">Data Transaksi Barang yang Dipinjam</h6><br>
                <p>Menampilkan seluruh transaksi yang sedang dipinjam di database inventaris.</p>
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
                      <td>
                        @if($data->status_peminjaman == 'Pinjam')
                        <form action="{{ route('borrow.update', $data->id) }}" method="POST">
                            {{csrf_field()}}
                            {{method_field('put')}}
                        <button class="btn btn-info btn-sm" onclick="return confirm('Anda yakin ingin mengembalikan transaksi ini?')"><i class="fas fa-arrow-left"></i> Kembalikan</button>
                      </form>
                      @else
                      <button class="btn btn-info btn-sm" onclick="return confirm('Anda yakin ingin mengembalikan transaksi ini?')" disabled="">Kembalikan</button>
                      @endif 
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
