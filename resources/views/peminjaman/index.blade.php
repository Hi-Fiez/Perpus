@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">List Peminjam Buku</div>

                <div class="panel-body">
                    @if(sizeof($peminjam)==0)
                    @else
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td>Nama Peminjam</td>
                                    <td>Alamat Peminjam</td>
                                    <td>Judul Buku</td>
                                    <td>Tanggal Pinjam</td>                                    
                                    <td>View</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peminjam as $item)                            
                                <tr>                                    
                                    <td>{{ $item->nama_peminjam }}</td>
                                    <td>{{ $item->alamat_peminjam }}</td>
                                    <td>{{ $item->judul_buku }}</td>
                                    <td>
                                        <?php                                        
                                        setlocale(LC_TIME, 'ID_id');
                                        setlocale(LC_ALL, 'id_ID');
                                        echo date('l, d F Y',strtotime($item->tanggal_pinjam));
                                        ?>
                                    </td>
                                    <td><a href="{{ url('pinjam')}}/{{ $item->id }}/edit" style="width: 100%;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;<b>Edit</b></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ url('pinjam/tambah') }}" class="btn btn-success" style="width: 100%;">Tambah Peminjam</a>
                        </div>
                        <div class="col-md-6">
                            @if(sizeof($peminjam)==0)
                            <a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
                            @else
                            <a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
                            @endif
                            <form id="export-form" action="{{ url('pinjam/export') }}" method="POST" style="display: none;">
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
