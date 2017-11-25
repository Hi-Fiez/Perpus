@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $buku->judul_buku }}</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td>Kode Buku</td>
                                    <td>Judul Buku</td>
                                    <td>Pengarang</td>
                                    <td>Kategori</td>
                                    <td>Stok</td>                                    
                                </tr>
                            </thead>
                            <tbody>                                                                
                                <td>{{ $buku->kode_buku }}</td>
                                <td>{{ $buku->judul_buku }}</td>
                                <td>{{ $buku->pengarang }}</td>
                                <td>{{ $buku->kategori }}</td>
                                <td>{{ $buku->stok }}</td>                                
                            </tr>                            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a onclick="event.preventDefault();document.getElementById('hapus-form').submit();" class="btn btn-danger" style="width: 100%;">Hapus</a>                    
                      <form id="hapus-form" action="{{ url('buku') }}/{{ $buku->kode_buku }}/destroy" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>                
        </div>
    </div>
</div>
</div>
</div>
@endsection
