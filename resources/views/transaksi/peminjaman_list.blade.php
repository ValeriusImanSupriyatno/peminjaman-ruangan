@extends('template.base')
@section('title','Peminjaman')
@section('description','Peminjaman')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Peminjaman Ruangan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List Peminjaman</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="DataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Kode</th>
                                    <th>Ruangan</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $no = 1; @endphp
                                @foreach($peminjaman as $pm)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$pm->peminjaman_kode}}</td>
                                        <td>{{$pm->nama_ruangan .' - '. $pm->kode_ruangan}}</td>
                                        <td>{{$pm->peminjaman_tgl_awal}}</td>
                                        <td>{{$pm->peminjaman_tgl_akhir}}</td>
                                        <td>{{empty($pm->is_active) ? '-' : ($pm->is_active == 'Y' ? 'Ijinkan' : 'Selesai')}}</td>
                                        <td>
                                            <a href="{{url('peminjaman/'.$pm->peminjaman_id.'/detail')}}"
                                               class="btn btn-sm btn-info"><i
                                                    class="nav-icon fas fa-eye"></i></a>
                                            {{--                                            <a href="{{url('peminjaman/'.$pm->peminjaman_id.'/delete')}}"--}}
                                            {{--                                               class="btn btn-sm btn-danger"><i--}}
                                            {{--                                                    class="nav-icon fas fa-trash-alt"></i></a>--}}
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
