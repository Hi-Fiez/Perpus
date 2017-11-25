@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Form Input Buku</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('buku/tambah') }}">
                        {{ csrf_field() }}                        

                        <div class="form-group">
                            <label for="kode_buku" class="col-md-4 control-label">Kode Buku</label>

                            <div class="col-md-6">
                                <input id="kode_buku" type="number" class="form-control" name="kode_buku" value="{{ old('kode_buku') }}" required>

                                @if ($errors->has('kode_buku'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kode_buku') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="judul_buku" class="col-md-4 control-label">Judul Buku</label>

                            <div class="col-md-6">
                                <input id="judul_buku" type="text" class="form-control" name="judul_buku" value="{{ old('judul_buku') }}" required>

                                @if ($errors->has('judul_buku'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul_buku') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pengarang" class="col-md-4 control-label">Pengarang</label>

                            <div class="col-md-6">
                                <input id="pengarang" type="text" class="form-control" name="pengarang" value="{{ old('pengarang') }}" required>

                                @if ($errors->has('pengarang'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pengarang') }}</strong>
                                    </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kategori" class="col-md-4 control-label">Kategori</label>

                            <div class="col-md-6">
                                <input id="kategori" type="text" class="form-control" name="kategori" value="{{ old('kategori') }}" required>

                                @if ($errors->has('kategori'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kategori') }}</strong>
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
                                    <a href="{{url('/')}}" class="btn btn-danger">Batal</a>
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
