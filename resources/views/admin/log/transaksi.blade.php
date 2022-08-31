

@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if (session()->get('sukses'))
                    <div class="alert alert-success">
                        {{ session()->get('sukses') }}
                    </div>
                @endif
                

                <h4 class="m-0 font-weight-bold text-primary">Log Peminjaman dan Pengembalian Barang</h4>

                <div class="col-md-12 text-right">
                    <a style="background-color: #008507" href="{{ route('file-ExportPeminjaman') }}" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-600">
                            <i class="fas fa-file-export mt-1"></i>
                        </span>
                        <span class="text">Export Riwayat</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Waktu dan Tanggal</th>
                                <th>Kode Barang</th>
                                <th>Nama Peminjam</th>
                                <th>Nama barang</th>
                                <th>Model / Type</th>
                                <th>Nomor Seri</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logTransaksi as $i=>$row)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td>{{$row->waktu}} - {{$row->tanggal_dipinjam}}</td>
                                <td>{{$row->stock->kode_barang}}</td>
                                <td>{{$row->pegawai->nama_lengkap}} - {{$row->pegawai->jabatan}} {{$row->pegawai->divisi}}</td>
                                <td>{{$row->stock->barang->nama_barang}}</td>
                                <td>{{$row->stock->barang->model}}</td>
                                <td>{{$row->stock->nomor_seri}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection