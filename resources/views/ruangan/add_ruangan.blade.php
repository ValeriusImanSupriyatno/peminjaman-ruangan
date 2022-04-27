@extends('template.base')
@section('title','Ruangan')
@section('description','Tambah Ruangan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Ruangan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah</h3>
            </div>


            <form id="form-tambah" action="{{url('ruangan')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Kode</label>
                                <input type="text" name="kode" class="form-control" id="kode">
                            </div>
                            <div class="form-group">
                                <label for="email">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hak">Hak Milik</label>
                                <select class="form-control select2" id="hak" name="hak_id" style="width: 100%;">
                                    <option value=""></option>
                                    @foreach($hakMilik as $hk)
                                        <option value="{{$hk->hak_id}}">{!! $hk->kode_hak!!}
                                            - {!! $hk->nama_hak !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control select2" id="kategori" name="kategori_id" style="width: 100%;">
                                    <option value=""></option>
                                    @foreach($kategori as $kr)
                                        <option value="{{$kr->kategori_id}}">{!! $kr->kode_kategori!!}
                                            - {!! $kr->nama_kategori !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" id="btn-submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="{{url('ruangan')}}" type="button" class="btn btn-sm btn-success">Kembali</a>
                </div>
            </form>
        </div>

    </div>
    <script>
        $(function () {
            $("#hak").select2({
                    placeholder: "Pilih Hak Milik"
                }
            );
            $("#kategori").select2({
                    placeholder: "Pilih Kategori"
                }
            );

            $("#btn-submit").on('click', function () {
                $("#form-tambah").submit();
            });
            $('#form-tambah').validate({
                rules: {
                    kode: {
                        required: true,
                    },
                    nama: {
                        required: true,
                    },
                    hak_id: {
                        required: true,
                    },
                    kategori_id: {
                        required: true,
                    },
                },
                messages: {
                    kode: {
                        required: "Silahkan masukkan kode",
                    },
                    nama: {
                        required: "Silahkan masukkan nama",
                    },
                    hak_id: {
                        required: "Silahkan isi pilihan hak milik",
                    },
                    kategori_id: {
                        required: "Silahkan isi pilihan kategori",
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
