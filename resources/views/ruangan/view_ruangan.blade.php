@extends('template.base')
@section('title','Ruangan')
@section('description','Detail Ruangan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Ruangan</h1>
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
                                        <th style="width:50%">Kode Ruangan</th>
                                        <td>{{$data['kode_ruangan']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Nama Ruangan</th>
                                        <td>{{$data['nama_ruangan']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Hak Milik</th>
                                        <td>{{$data['nama_hak']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Kategori</th>
                                        <td>{{$data['nama_kategori']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Kapasitas</th>
                                        <td>{{$data['kapasitas']}}</td>
                                    </tr>
                                    <tr>
                                        <th style="width:50%">Deskripsi</th>
                                        <td>{{$data['deskripsi_ruangan']}}</td>
                                    </tr>
                                </table>
                                <a href="{{url('ruangan')}}" class="btn btn-sm btn-success">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fasilitas</h3>
                </div>

                <div class="card-body">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                            data-target="#tambah-fasilitas">
                        <i class="nav-icon fas fa-plus"></i>
                        Tambah
                    </button>
                    </p>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Fasilitas</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($listFasilitas as $lf)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$lf->nama_fasilitas}}</td>
                                <td>{{$lf->detru_jumlah}}</td>
                                <td>
                                    <a href="#"
                                       class="btn btn-sm btn-primary edit" data-toggle="modal"
                                       data-target="#edit-fasilitas"
                                       data-id="{!! $lf->detru_id !!}"
                                       data-kode="{!! $lf->detru_fasilitas_id !!}"
                                       data-jumlah="{!! $lf->detru_jumlah !!}">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </a>
                                    <a href="{{url('detail-ruangan/'.$lf->detru_id.'/delete')}}"
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

    <div class="modal fade" id="tambah-fasilitas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Fasilitas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah" action="{{url('detail-ruangan')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="fasilitas">Fasilitas</label>
                            <select class="form-control select2" id="fasilitas" name="fasilitas" style="width: 100%;">
                                <option value=""></option>
                                @foreach($fasilitas as $fs)
                                    <option value="{{$fs->fasilitas_id}}">{!! $fs->kode_fasilitas!!}
                                        - {!! $fs->nama_fasilitas !!}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="idRuangan" value="{{$data['ruangan_id']}}">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btn-submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-fasilitas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Fasilitas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" action="{{url('detail-ruangan/update')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="fasilitas">Fasilitas</label>
                            <select class="form-control select2" id="edit-fasilitas-id" name="edit_id_fasilitas"
                                    style="width: 100%;">
                                @foreach($fasilitas as $fs)
                                    <option value="{{$fs->fasilitas_id}}">
                                        {!! $fs->kode_fasilitas!!} - {!! $fs->nama_fasilitas !!}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="edit_id_ruangan" value="{{$data['ruangan_id']}}">
                            <input type="hidden" id="edit-id" name="id_detru">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" name="edit_jumlah" id="edit-jumlah"
                                   placeholder="Jumlah">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btn-edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {

            $('.select2').select2({placeholder: "Pilih Fasilitas"});

            $(".edit").on('click', function () {
                $('#edit-fasilitas-id').val($(this).data('kode')).trigger("change");
                $('#edit-jumlah').val($(this).data('jumlah'));
                $('#edit-id').val($(this).data('id'));
            });

            $("#btn-edit").on('click', function () {
                $("#form-edit").submit();
            });

            $("#btn-submit").on('click', function () {
                $("#form-tambah").submit();
            });
            $('#form-tambah').validate({
                rules: {
                    fasilitas: {
                        required: true,
                    },
                    jumlah: {
                        number: true,
                    },
                },
                messages: {
                    fasilitas: {
                        required: "Silahkan masukkan fasilitas",
                    },
                    jumlah: {
                        number: "Silahkan masukkan angka",
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
