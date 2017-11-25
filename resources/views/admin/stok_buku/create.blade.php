@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">Stok Buku</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('stok/tambah') }}">
                        {{ csrf_field() }}                        

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
                            <label for="nomor_rak" class="col-md-4 control-label">Nomor Rak</label>

                            <div class="col-md-6">
                                <input id="nomor_rak" type="number" class="form-control" name="nomor_rak" value="{{ old('nomor_rak') }}" required>

                                @if ($errors->has('nomor_rak'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nomor_rak') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_buku" class="col-md-4 control-label">Jumlah Buku</label>

                            <div class="col-md-6">
                                <input id="jumlah_buku" type="number" class="form-control" name="jumlah_buku" value="{{ old('jumlah_buku') }}" required>

                                @if ($errors->has('jumlah_buku'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('jumlah_buku') }}</strong>
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
