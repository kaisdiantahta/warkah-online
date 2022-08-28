@extends('layouts.master')

@section('title', 'Sistem Perpustakaan')

@php
  use Carbon\Carbon;
  use App\Constants\StatusPeminjaman;
@endphp
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Log Peminjaman Buku</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard Peminjaman</a></li>
            <li class="breadcrumb-item active">index</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      {{-- Alert --}}
      @if (\Session::has('message'))
          {!! \Session::get('message') !!}
      @endif

      <div class="row my-3">
        <div class="col-lg col-md-12">
          <div class="card small-9">
            <div class="card-body">
              <div class="row my-3">
                <div class="col-md-12">
                  <a href="{{ route('peminjaman.form-peminjaman') }}" class="btn btn-primary text-white"><i class="fas fa-plus"></i> Form Peminjaman Buku</a>
                </div>
              </div>
              <div class="row">
                <div class="col-lg col-md-12">
                  <table id="example1" class="table table-bordered table-hover datatables-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Batas Pengembalian</th>
                        <th>Tanggal Kembali</th>
                        <th>Total Denda</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $val)
                          <tr class="align-middle">
                            <td>
                              <div class="btn-group transparent">
                                <a href="{{ route('peminjaman.detail-peminjaman', $val->id) }}" class="btn btn-sm btn-primary custom-hover" title="Detail"><i class="fas fa-fw fa-eye"></i></a>
                                @if ($val->status == StatusPeminjaman::PEMINJAMAN)
                                  <a href="{{ route('peminjaman.pengembalian', $val->id) }}" class="btn btn-sm btn-primary custom-hover" title="Form Pengembalian"><i class="fas fa-fw fa-check"></i></a>
                                @endif
                              </div>
                            </td>
                            <td>{{ $val->nama_peminjam }}</td>
                            <td>
                              @forelse ($val->pinjam as $pinjam)
                                {{ $pinjam->book->judul.', ' }}
                              @empty
                                -
                              @endforelse
                            </td>
                            <td>{{ Carbon::parse($val->pinjam[0]->tanggal_pinjam)->translatedFormat('d M Y') }}</td>
                            <td>{{ Carbon::parse($val->pinjam[0]->batas_pengembalian)->translatedFormat('d M Y') }}</td>
                            <td>{{ !is_null($val->pinjam[0]->tanggal_kembali) ? Carbon::parse($val->pinjam[0]->tanggal_kembali)->translatedFormat('d M Y') : '-'}}</td>
                            <td>
                              @php
                                $denda = 0;
                                foreach ($val->pinjam as $key => $pinjam) {
                                  $denda += $pinjam->denda ?? 0;
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div><!-- /.container-fluid -->
</div>
@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('scripts')
  <script src="{{ asset('js/ujs.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
    });
  </script>
@endsection