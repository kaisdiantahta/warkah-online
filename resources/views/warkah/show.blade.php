@extends('layouts.master')

@section('title', 'Search')


@section('content')
<div class="content-header">
    <div class="container-fluid">

      @if (\Session::has('message'))
          {!! \Session::get('message') !!}
      @endif

      <div class="row my-3">
        <div class="col-lg col-md-12">
          <div class="card card-primary small-9">
              <div class="card-header">
              <h5 class="card-title">Pencarian</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('warkah.search') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Pemilik</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="Input nama Pemilik" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Akta</label>
                        <input type="text" name="akta" id="" class="form-control" placeholder="Input nomor akta" value="{{ old('akta') }}" required>
                        @error('akta')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary float-right px-3">Cari Dokumen</button>
                    </div>
                </form>
                 @if (\Session::has('param'))
                 <h4>Berikut Daftar File Pada pencarian yang kamu cari :</h4>
                  <ul>
                    @foreach(Session::get('file') as $file_s )
                    <li style="font-size:20px;color:black;"> <a href="../data_file/{{$file_s->file}}">{{$file_s->nama_file}}</a> </li>
                    @endforeach
                  </ul>
                @endif
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
        
</div>
@endsection

