@extends('template.base')
@section('title','Fasilitas')
@section('description','Ubah Fasilitas')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Fasilitas</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Ubah</h3>
            </div>


            <form id="form-edit" action="{{url('fasilitas/'.$data['fasilitas_id'])}}" method="GET">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="kode">Kode</label>
                        <input type="text" name="kode" class="form-control" id="kode" value="{{$data['kode_fasilitas']}}">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{$data['nama_fasilitas']}}">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" id="btn-submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="{{url('fasilitas')}}" type="button" class="btn btn-sm btn-success">Kembali</a>
                </div>
            </form>
        </div>

    </div>
    <script>
        $(function () {
            $("#btn-submit").on('click', function () {
                $("#form-edit").submit();
            });
            $('#form-edit').validate({
                rules: {
                    kode: {
                        required: true,
                    },
                    nama: {
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
