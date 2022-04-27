@extends('template.base')
@section('title','Kategori Ruangan')
@section('description','Kategori Ruangan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategori Ruangan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <a href="{{url('kategori-ruangan/create')}}" class="btn btn-sm btn-success"><i
                    class="nav-icon fas fa-plus"></i>
                Tambah</a>
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="DataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach($data as $kr)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$kr->kode_kategori}}</td>
                                        <td>{{$kr->nama_kategori}}</td>
                                        <td>
                                            <a href="{{url('kategori-ruangan/'.$kr->kategori_id.'/edit')}}"
                                               class="btn btn-sm btn-primary"><i
                                                    class="nav-icon fas fa-edit"></i></a>
                                            <a href="{{url('kategori-ruangan/'.$kr->kategori_id.'/delete')}}"
                                               class="btn btn-sm btn-danger"><i
                                                    class="nav-icon fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function () {
            $("#DataTable").DataTable({
                "responsive": true,
                "autoWidth": false
            });
        });
    </script>
@endsection
