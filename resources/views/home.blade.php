@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if(sizeof($buku)==0)
                    @else
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td>Kode Buku</td>
                                    <td>Judul Buku</td>
                                    <td>Pengarang</td>
                                    <td>Kategori</td>
                                    <td>Stok</td>
                                    <td>View</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($buku as $item)
                                @if($item->stok==0)
                                <tr class="warning">
                                    @else
                                    <tr>
                                        @endif
                                        <td>{{ $item->kode_buku }}</td>
                                        <td>{{ $item->judul_buku }}</td>
                                        <td>{{ $item->pengarang }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        @if($item->stok==0)
                                        <td class="danger">{{ $item->stok }}</td>
                                        <td>
                                            <a href="{{ url('buku')}}/{{ $item->kode_buku }}" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<b>Lihat</b></a>
                                            <a href="{{ url('stok/tambah')}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;<b>Tambah Stok</b></a>
                                        </td>
                                        @else
                                        <td>{{ $item->stok }}</td>
                                        <td><a href="{{ url('buku')}}/{{ $item->kode_buku }}" style="width: 100%;" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;<b>Lihat</b></a></td>
                                        @endif                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ url('buku/tambah') }}" class="btn btn-success" style="width: 100%;">Tambah Buku</a>
                            </div>
                            <div class="col-md-6">
                                @if(sizeof($buku)==0)
                                <a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary disabled" style="width: 100%;">Export ke Excel</a>
                                @else
                                <a onclick="event.preventDefault();document.getElementById('export-form').submit();" class="btn btn-primary" style="width: 100%;">Export ke Excel</a>
                                @endif
                                <form id="export-form" action="{{ url('buku/export') }}" method="POST" style="display: none;">
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
<!-- <td class="active">...</td>
<td class="success">...</td>
<td class="warning">...</td>
<td class="danger">...</td>
<td class="info">...</td> -->