@extends('Layout.layout')
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
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{$title}}</h4>
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Tanggal</th>
                                        <th>No SK</th>
                                        <th>Nama File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($data_bimbingan as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$row->nama_mahasiswa}}</td>
                                        <td>{{$row->tanggal}}</td>
                                        <td>{{$row->no_sk}}</td>
                                        <td>{{$row->nama_file}}</td>
                                        <td><a href="#modalEdit{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="#modalHapus{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                            <a href="{{ asset('penyimpanan/bimbingan/' . $row->nama_file) }}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> View File</a>
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
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="/bimbingan/store" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama_mahasiswa" placeholder="Nama Mahasiswa" required>
                    </div>
                    <div class="form-group">
                        <label>tanggal</label>
                        <input type="date" class="form-control" name="tanggal" placeholder="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>No SK</label>
                        <input type="text" class="form-control" name="no_sk" placeholder="No SK" required>
                    </div>
                    <div class="form-group">
                        <label>Nama File</label>
                        <input type="file" class="form-control" name="nama_file" placeholder="Nama File" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data_bimbingan as $d)
<div class="modal fade" id="modalEdit{{$d->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="/bimbingan/update/{{$d->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" value="{{$d->nama_mahasiswa}}" class="form-control" name="nama_mahasiswa" placeholder="Nama Mahasiswa" required>
                    </div>
                    <div class="form-group">
                        <label>tanggal</label>
                        <input type="date" value="{{$d->tanggal}}" class="form-control" name="tanggal" placeholder="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>No SK</label>
                        <input type="text" value="{{$d->no_sk}}" class="form-control" name="no_sk" placeholder="No SK" required>
                    </div>
                    <div class="form-group">
                        <label>Nama File</label>
                        <input type="file" class="form-control" name="nama_file" placeholder="Nama File">
                        <small class="text-muted">Current File: {{$d->nama_file}}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($data_bimbingan as $c)
<div class="modal fade" id="modalHapus{{$c->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="/bimbingan/destroy/{{$c->id}}" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <h5>Apakah anda ingin menghapus data ini?</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection