@extends('layout.layout')
@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$title}}</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{$title}}</h4>
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="model" data-target="#modelCreate">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>NIP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($data_dosen as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->nip}}</td>
                                        <td><a href="#modalEdit{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#modalHapus{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
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
</div>
@endsection