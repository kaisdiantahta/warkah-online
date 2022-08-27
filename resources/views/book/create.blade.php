@extends('layouts.master')

@section('title', 'Sistem Perpustakaan')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Buku</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Buku</a></li>
            <li class="breadcrumb-item active">index</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      @if (\Session::has('message'))
          {!! \Session::get('message') !!}
      @endif

      <div class="row my-3">
        <div class="col-lg col-md-12">
          <div class="card card-primary small-9">
            <div class="card-header">
              <h5 class="card-title">Form Tambah Buku</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('book.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Judul Buku</label>
                        <input type="text" name="judul" id="" class="form-control" placeholder="Input judul buku" value="{{ old('judul') }}" required>
                        @error('judul')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Pengarang</label>
                        <input type="text" name="pengarang" id="" class="form-control" placeholder="Input pengarang" value="{{ old('pengarang') }}">
                        @error('pengarang')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Penerbit</label>
                        <input type="text" name="penerbit" id="" class="form-control" placeholder="Input penerbit" value="{{ old('penerbit') }}">
                        @error('penerbit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" id="" class="form-control" placeholder="Input tahun terbit" value="{{ old('tahun_terbit') }}" min="1900" max="2100">
                        @error('tahun_terbit')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">No. ISBN</label>
                        <input type="text" name="isbn" id="" class="form-control" placeholder="Input nomor ISBN" value="{{ old('isbn') }}">
                        @error('isbn')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Stok Buku</label>
                        <input type="number" name="stok" id="" class="form-control" placeholder="Input jumlah stok buku" value="{{ old('stok') }}" min="0">
                        @error('stok')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary float-right px-3">Simpan</button>
                    </div>
                </form>
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