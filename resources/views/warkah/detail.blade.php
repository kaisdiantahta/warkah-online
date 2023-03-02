@extends('layouts.master')

@section('title', 'Detail Dokumen')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">
          {{-- <ol class="breadcrumb float-sm-right">
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
          <div class="card card-primary small-9">
            <div class="card-header">
              <h5 class="card-title">Detail Dokumen</h5>
            </div>
            <div class="card-body">
                <div class="row my-3">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalLong">
                         Komentar
                        </button>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Komentar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('warkah.add_komentar', $warkah->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                <div class="modal-body">

                                    <input type="hidden">   
                                        <textarea class="form-control" id="" rows="4" name="komentar" value="{{ $warkah->komentar }}">{{ $warkah->komentar }}sdsd</textarea>
                                       
                                    <button type="button" class="btn btn-secondary mt-2 mb-2 float-right" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary float-right px-4 m-1 mt-2 mb-2">Simpan</button>
                                </div>
                                </form>   
                            </div>
                        </div>
                    </div>
                <form action="{{ route('warkah.update', $warkah->id) }}" method="post" enctype="multipart/form-data">
                     @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Nomor Akta</label>
                        <input type="text" name="nomor_akta" id="" class="form-control form-control-sm" placeholder="Input Nomor Akta" value="{{ $warkah->nomor_akta }}" required>
                        @error('nomor_akta')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pihak 1</label>
                        <input type="text" name="nama_pihak1" id="" class="form-control form-control-sm" placeholder="Input Nama Pihak 1" value="{{  $warkah->nama_pihak1 }}" required>
                        
                        @error('nama_pihak1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pihak 2</label>
                        <input type="text" name="nama_pihak2" id="" class="form-control form-control-sm" placeholder="Input Nama Pihak 2" value="{{ $warkah->nama_pihak2 }}" required>
                        @error('nama_pihak2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Rincian</label>
                        <input type="text" name="rincian" id="" class="form-control form-control-sm" placeholder="Input Rincian" value="{{ $warkah->rincian }}"required>
                        @error('rincian')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" id="" class="form-control form-control-sm" placeholder="Input Alamat" value="{{$warkah->alamat }}"  required>
                        @error('alamat')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nominal Transaksi</label>
                        <input type="number" name="nominal_transaksi" id="" class="form-control form-control-sm" placeholder="Input Nominal Transaksi" value="{{$warkah->nominal_transaksi }}" min="0"required>
                        @error('nominal_transaksi')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      </div>
                        
                        <br><br>
                        <label  for="document">Dokumen</label><br>
                        @if($warkah->nama_file)
                         <a href="../../data_file/{{$warkah->file}}">
                            <img src="/img/pdf.png" id="documen" style="width:90px;">
                        <a>
                        @endif
                    <div class="form-group row justify-content-end">
                        <a href="{{ route('warkah.index') }}" class="btn btn-secondary float-right px-4 m-1">Batal</a>
                        <button class="btn btn-primary float-right px-4 m-1">Simpan</button>
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
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/select2/css/select2.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('scripts')
  <script src="{{ asset('admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
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