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
          <h1 class="m-0 text-dark">Detail Buku</h1>
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
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th width="200px">Judul</th>
                        <td>{{ $book->judul ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $book->category->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pengarang</th>
                        <td>{{ $book->pengarang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>{{ $book->penerbit ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>{{ $book->tahun_terbit ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>{{ $book->isbn ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $book->stok ?? 0 }}</td>
                    </tr>
                </table>

                <div class="form-group my-3">
                    <a href="{{ route('book.index') }}" class="btn btn-secondary float-right px-4 m-1">Kembali</a>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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