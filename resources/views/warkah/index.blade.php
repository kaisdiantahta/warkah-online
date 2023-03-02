@extends('layouts.master')

@section('title', 'Sistem Warkah')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Log Pelaporan Dokumen</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 small-9">
          {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Buku</a></li>
            <li class="breadcrumb-item active">index</li>
          </ol> --}}
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
              <div class="row">
                <div class="col-lg col-md-12">
                  <table id="example1" class="table table-bordered table-hover datatables-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>Nomor</th>
                        <th>Alamat</th>
                        <th>Rincian</th>
                        <th>KOmentar</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($warkahs as $warkah)
                          <tr class="align-middle">
                            <td class="text-center col-2">
                              <div class="btn-group transparent">
                                <a data-method="delete" data-confirm="Anda yakin ingin menghapus data ini?" href="{{ route('warkah.delete', $warkah->id) }}"class="btn btn-sm btn-primary custom-hover" title="Hapus"><i class="fas fa-fw fa-trash"></i></a>
                                <a href="{{ route('warkah.edit', $warkah->id) }}" class="btn btn-sm btn-primary custom-hover" title="Edit"><i class="fas fa-fw fa-edit"></i></a>
                                <a href="{{ route('warkah.detail', $warkah->id) }}" class="btn btn-sm btn-primary custom-hover" title="Detail"><i class="fas fa-fw fa-eye"></i></a>

                              </div>
                            </td>
                            <td>{{ $warkah->nama_pihak1   }} {{' - '. $warkah->nama_pihak2 ?? '-'  }}</td>
                            <td>{{ $warkah->nomor_akta ?? '-' }}</td>
                            <td>{{ $warkah->alamat ?? '-'  }}</td>
                            <td>{{ $warkah->rincian ?? '-'  }}</td>
                            <td>{{ $warkah->komentar ?? '-'  }}</td>
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