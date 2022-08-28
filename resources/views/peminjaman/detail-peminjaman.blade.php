@extends('layouts.master')

@section('title', 'Sistem Perpustakaan')


@section('content')
@php
    use Carbon\Carbon;
    use App\Constants\StatusPeminjaman;
    $total = 0
@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Peminjaman Buku</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">{{-- 
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Buku</a></li>
            <li class="breadcrumb-item active">index</li>
          </ol> --}}
        </div><!-- /.col -->
      </div><!-- /.row -->

      @if (\Session::has('message'))
          {!! \Session::get('message') !!}
      @endif

      <div class="row my-3">
        <div class="col-lg col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h6 class="text-uppercase font-weight-bold">A. Identitas Peminjam</h6>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th width="200px">Nama</th>
                        <td>{{ $data->nama_peminjam }}</td>
                    </tr>
                    <tr>
                        <th>No. Identitas</th>
                        <td>{{ $data->no_identitas }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td>{{ Carbon::parse($data->pinjam[0]->tanggal_pinjam)->translatedFormat('l, d F Y') }}</td>
                    </tr>
                    <tr>
                        <th>Batas Pengembalian</th>
                        @php
                            $batas = Carbon::parse($data->pinjam[0]->batas_pengembalian)->translatedFormat('Ymd');
                        @endphp
                        <td class="{{ date('Ymd') > $batas ? 'bg-danger' : '' }}">
                            <span class="font-weight-bold">
                                {{ Carbon::parse($batas)->translatedFormat('l, d F Y') }} 
                                @if (date('Ymd') > $batas)
                                    <i>
                                        (terlambat {{ Carbon::parse($batas)->diffForHumans(null, true) }})
                                    </i>
                                @endif
                            </span>
                        </td>
                    </tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          <div class="card">
            {{-- <div class="card-header"> --}}
              {{-- <h5 class="card-title">Form Peminjaman Buku</h5> --}}
            {{-- </div> --}}
            <div class="card-body">
                <h6 class="text-uppercase font-weight-bold">B. Daftar Pengembalian Buku</h6>
                <table id="example1" class="table table-bordered table-hover datatables-responsive">
                    <thead>
                      <tr>
                        <th>Buku</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data->pinjam as $key => $pinjam)
                          <tr class="align-middle">
                            <td>
                                <b>{{ $pinjam->book->judul ?? '-' }}</b>
                                <span class="font-italic">
                                    ({{ $pinjam->book->pengarang.', '.$pinjam->book->penerbit.', '.$pinjam->book->tahun_terbit }})
                                </span>
                            </td>
                            <td>{{ Carbon::parse($pinjam->tanggal_kembali)->translatedFormat('l, d F Y') }}</td>
                            <td>
                                @php
                                    if (date('Ymd') > $batas) {
                                        $terlambat = date('Ymd') - $batas;
                                        $denda = 1000*$terlambat;
                                        $total += $denda;
                                    }
                                @endphp
                                Rp {{ number_format($denda ?? 0, 0, ',', '.') }}
                            </td>
                            <td>
                                {!! StatusPeminjaman::html($pinjam->status) !!}
                            </td>
                          </tr>
                      @endforeach
                    </tbody>
                </table>
                <h5 class="font-weight-bold my-2">Total Denda : Rp {{ number_format($total ?? 0, 0, ',', '.') }}</h5>
                <div class="form-group row justify-content-end">
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary float-right px-4 m-1">Kembali</a>
                </div>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
</div>
@endsection

@section('styles')

  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <style type="text/css">
    input[type=checkbox] {
        transform: scale(1.5);
    }
  </style>
@endsection

@section('scripts')
  <script src="{{ asset('admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script>
    $(function () {
    });
  </script>
@endsection