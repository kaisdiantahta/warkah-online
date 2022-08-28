@extends('layouts.master')

@section('title', 'Sistem Perpustakaan')


@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Form Peminjaman Buku</h1>
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
          <div class="card card-primary card-outline small-9">
            {{-- <div class="card-header"> --}}
              {{-- <h5 class="card-title">Form Peminjaman Buku</h5> --}}
            {{-- </div> --}}
            <div class="card-body">
                <form action="{{ route('peminjaman.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Peminjam</label>
                        <input type="text" name="peminjam" id="" class="form-control form-control-sm" placeholder="Input nama peminjam buku" value="{{ old('peminjam') }}" required>
                        @error('peminjam')
                            <div class="text-danger">Nama peminjam wajib diisi</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">No. Identitas</label>
                        <input type="text" name="no_identitas" id="" class="form-control form-control-sm" placeholder="Input nama no_identitas buku" value="{{ old('no_identitas') }}" required>
                        @error('no_identitas')
                            <div class="text-danger">Nomor identitas wajib diisi</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <table width="100%" cellspacing="5" cellpadding="5">
                            <tbody class="repeat-container">
                                <tr>
                                    <label for="">Pilih Buku</label>
                                </tr>
                                <tr class="repeat-row">
                                    <td class="pl-0">
                                        <div class="form-box">
                                            <select name="books[]" class="form-control form-control-sm buku" data-placeholder="Pilih Buku" >
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </td>
                                    <td class="repeat-action" style="width: 20px; vertical-align: middle;">
                                        <a href="#" class="repeat-add"><i class="fa fa-2x fa-plus-square"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @error('books.0')
                            <div class="text-danger">Buku wajib diisi</div>
                        @enderror
                    </div>
                    <div class="form-group row justify-content-end">
                        <button class="btn btn-secondary float-right px-4 m-1">Batal</button>
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

        $(".buku").select2({
          ajax: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
              url: "{{ route('book.json-all') }}",
              type: 'get',
              dataType: 'json',
              delay: 250,
              processResults: function (data) {
                return {
                  results:  $.map(data, function (item) {
                    console.log(item)
                    return {
                      text: item.judul + ' (' + item.pengarang + ', ' + item.penerbit + ', ' + item.tahun_terbit + ')',
                      id: item.id
                    }
                  })
                };
              },
              cache: true
            }
        });        

      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });

      $(document).on('click', '.repeat-add', function(e) {
            e.preventDefault();
            $(this).closest('.repeat-container').append(`
                <tr class="repeat-row">
                    <td class="pl-0">
                        <div class="form-box">
                            <select name="books[]" class="form-control buku" data-placeholder="Pilih Buku" >
                                <option value=""></option>
                            </select>
                        </div>
                    </td>
                    <td class="repeat-action" style="width: 20px">
                        <a href="#" class="repeat-remove"><i class="fa fa-2x fa-minus-square"></i></a>
                    </td>
                </tr>
            `);
            $(".buku").select2({
              ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                  url: "{{ route('book.json-all') }}",
                  type: 'get',
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                    return {
                      results:  $.map(data, function (item) {
                        console.log(item)
                        return {
                          text: item.judul + ' (' + item.pengarang + ', ' + item.penerbit + ', ' + item.tahun_terbit + ')',
                          id: item.id
                        }
                      })
                    };
                  },
                  cache: true
                }
            }); 
        });
      $(document).on('click', '.repeat-remove', function(e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
    });
  </script>
@endsection