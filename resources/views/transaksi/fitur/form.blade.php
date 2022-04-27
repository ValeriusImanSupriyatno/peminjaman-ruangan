@extends('template.base')
@section('title','Pengajuan')
@section('description','Pengajuan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Peminjaman</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row" style="margin-left: 0px;margin-right: 0px">
        <div class="col-md-6">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Jadwal Ruangan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($transaksi as $tr)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$tr->peminjaman_tgl_awal}} s.d {{$tr->peminjaman_tgl_akhir}}</td>
                                <td>{{$tr->peminjaman_jam_awal}} s.d {{$tr->peminjaman_jam_akhir}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{$transaksi->links()}}
                </div>
            </div>
        </div>

        <div class="col-md-6">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Peminjaman</h3>
                </div>

                <form id="form-tambah" method="post" action="{{url('pinjam-ruangan')}}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggalAwal">Tanggal Awal</label>
                                    <input type="date" name="tanggalAwal" class="form-control" id="tanggalAwal">
                                    <input type="hidden" name="ruangan" value="{{$ruangan->ruangan_id}}" id="ruangan">
                                    <input type="hidden" name="user" value="{{$session['user_id']}}" id="user">
                                </div>
                                <div class="form-group">
                                    <label for="jamMulai">Jam Mulai</label>
                                    <input type="time" name="jamMulai" class="form-control" id="jamMulai">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="kegiatan">Kegiatan</label>
                                        <input type="text" name="kegiatan" class="form-control" id="kegiatan">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tanggalAkhir">Tanggal Berakhir</label>
                                    <input type="date" name="tanggalAkhir" class="form-control" id="tanggalAkhir">
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="jamBerakhir">Jam Berakhir</label>
                                        <input type="time" name="jamBerakhir" class="form-control" id="jamBerakhir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="telp">No. Telp</label>
                                        <input type="text" name="telp" class="form-control" id="telp">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" id="btn-submit" class="btn btn-sm btn-primary">Simpan</button>
                        <a href="{{url('pinjam-ruangan')}}" type="button" class="btn btn-sm btn-success">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function () {

            $("#btn-submit").on('click', function (event) {
                event.preventDefault();

                let validate = $("#form-tambah").valid();
                if (validate) {
                    $("#form-tambah").submit();
                }

            });
            $('#form-tambah').validate({
                rules: {
                    tanggalAwal: {
                        required: true,
                    },
                    tanggalAkhir: {
                        required: true,
                    },
                    jamMulai: {
                        required: true,
                    },
                    jamBerakhir: {
                        required: true,
                    },
                    kegiatan: {
                        required: true,
                    },
                    telp: {
                        required: true,
                        number: true
                    },
                },
                messages: {
                    telp: {
                        number: "Silahkan masukan No.Telp yang benar",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });

        });
    </script>
@endsection
