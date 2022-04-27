@extends('template.base')
@section('title','Ruangan')
@section('description','Ruangan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ruangan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">

            <a href="{{url('ruangan/create')}}" class="btn btn-sm btn-success"><i
                    class="nav-icon fas fa-plus"></i>
                Tambah</a>
            </p>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Ruangan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="DataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Hak Milik</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach($data as $rm)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$rm->kode_ruangan}}</td>
                                        <td>{{$rm->nama_ruangan}}</td>
                                        <td>{{$rm->kode_hak}} - {{$rm->nama_hak}}</td>
                                        <td>{{$rm->kode_kategori}} - {{$rm->nama_kategori}}</td>
                                        <td>
                                            <a href="{{url('ruangan/'.$rm->ruangan_id.'/detail')}}"
                                               class="btn btn-sm btn-info"><i
                                                    class="nav-icon fas fa-eye"></i></a>
                                            <a href="{{url('ruangan/'.$rm->ruangan_id.'/edit')}}"
                                               class="btn btn-sm btn-primary"><i
                                                    class="nav-icon fas fa-edit"></i></a>
                                            <a href="{{url('ruangan/'.$rm->ruangan_id.'/delete')}}"
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
