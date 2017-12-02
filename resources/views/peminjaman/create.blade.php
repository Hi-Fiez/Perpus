@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Form Peminjaman</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('pinjam/tambah') }}">
                        {{ csrf_field() }}                        

                        <div class="form-group">
                            <label for="nama_peminjam" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nama_peminjam" id="nama_peminjam" required>

                                @if ($errors->has('nama_peminjam'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nama_peminjam') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_peminjam" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <textarea id="alamat_peminjam" class="form-control" name="alamat_peminjam" value="{{ old('alamat_peminjam') }}" required>
                                </textarea>

                                @if ($errors->has('alamat_peminjam'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('alamat_peminjam') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="judul_buku" class="col-md-4 control-label">Nama Buku</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="judul_buku" list="judul" 
                                id="judul_buku" required>
                                <datalist id="judul" >                                    
                                    @foreach($buku as $item)
                                    <option value="{{$item->judul_buku}}">{{$item->judul_buku}}</option>@endforeach
                                </datalist>

                                @if ($errors->has('judul_buku'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('judul_buku') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>

                            <div class="col-md-6">
                                <?php
                                $tanggal =  date("Y-m-d");
                                ?>
                                <input id="tanggal_pinjam" type="date" class="form-control" name="tanggal_pinjam" value="{{$tanggal}}" required readonly autofocus>

                                @if ($errors->has('tanggal_pinjam'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tanggal_pinjam') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status_peminjam" class="col-md-4 control-label">Status Pinjam</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="status_peminjam" id="status_peminjam" value="Belum Kembali" required readonly>

                                @if ($errors->has('status_peminjam'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status_peminjam') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <a href="{{url('pinjam')}}" class="btn btn-danger">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
