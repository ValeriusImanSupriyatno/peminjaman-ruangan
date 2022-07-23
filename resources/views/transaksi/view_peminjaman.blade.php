@extends('template.base')
@section('title','Ruangan')
@section('description','Detail Peminjaman')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Peminjaman</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row" style="margin-left: 0px;margin-right: 0px">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="post">
                            <p class="lead">Peminjaman</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Ruangan</th>
                                        <td>{{$data['nama_ruangan'] .' - '.$data['kode_ruangan']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Peminjam</th>
                                        <td>{{$data['name']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Kode</th>
                                        <td>{{$data['peminjaman_kode']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Tanggal</th>
                                        <td>{{$data['peminjaman_tgl_awal']}}
                                            - {{$data['peminjaman_tgl_akhir']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Jam</th>
                                        <td>{{date('H:i',strtotime($data['peminjaman_jam_awal']))}}
                                            - {{date('H:i',strtotime($data['peminjaman_jam_akhir']))}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Telp</th>
                                        <td>{{$data['peminjaman_telp']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Kegiatan</th>
                                        <td>{{$data['peminjaman_kegiatan']}}</td>
                                    </tr>
                                </table>
                                <form action="{{url('/peminjaman/'.$data['peminjaman_id'])}}" method="get"
                                      id="form-edit">
                                    <a href="{{url('peminjaman')}}" class="btn btn-sm btn-success">Kembali</a>
                                    @if($session['role'] === 'admin')
                                        @if(empty($data['is_active']) === true)
                                            <input type="hidden" name="user" value="{{$session['user_id']}}" id="user">
                                            <button class="btn btn-sm btn-primary" type="submit" id="btn-acc" name="acc"
                                                    value="Y">
                                                Ijinkan
                                            </button>
                                        @endif
                                        @if($data['is_active'] === 'Y')
                                            <button class="btn btn-sm btn-info" type="submit" name="kembali" value="N">
                                                Pengembalian Kunci
                                            </button>
                                        @endif
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#hak').select2();
            $('#kategori').select2();

            $("#btn-acc").on('click', function () {
                $("#form-edit").submit();
            });
        });
    </script>

@endsection
