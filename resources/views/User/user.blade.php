@extends('template.base')
@section('title','User')
@section('description','User')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">

            <a href="{{url('user/create')}}" class="btn btn-sm btn-success"><i class="nav-icon fas fa-plus"></i>
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
                            <table id="data-user" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach($user as $us)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$us->name}}</td>
                                        <td>{{$us->username}}</td>
                                        <td>
                                            <a href="{{url('user/'.$us->user_id.'/edit')}}"
                                               class="btn btn-sm btn-primary"><i
                                                    class="nav-icon fas fa-edit"></i></a>
                                            <a href="{{url('user/'.$us->user_id.'/delete')}}"
                                               class="btn btn-sm btn-danger"><i
                                                    class="nav-icon fas fa-trash-alt"></i></a>
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
    </section>
    <script>
        $(function () {
            $("#data-user").DataTable({
                "responsive": true,
                "autoWidth": false
            });
        });
    </script>
@endsection
