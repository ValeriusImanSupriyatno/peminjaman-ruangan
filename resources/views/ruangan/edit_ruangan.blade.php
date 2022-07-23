@extends('template.base')
@section('title','Ruangan')
@section('description','Ubah Ruangan')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Ruangan</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Ubah</h3>
            </div>


            <form id="form-edit" action="{{url('ruangan/'.$data['ruangan_id'])}}" method="GET">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Kode</label>
                                <input type="text" name="kode" class="form-control" id="kode"
                                       value="{{$data['kode_ruangan']}}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                       value="{{$data['nama_ruangan']}}">
                            </div>
                            <div class="form-group">
                                <label for="nama">Kapasitas</label>
                                <input type="text" name="kapasitas" class="form-control" id="kapasitas"
                                       value="{{$data['kapasitas']}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hak">Hak Milik</label>
                                <select class="form-control select2" id="hak" name="hak_id" style="width: 100%;">
                                    @foreach($hakMilik as $hk)
                                        <option value="{{$hk->hak_id}}"
                                            {!! $hk->hak_id === $data['ruangan_hak_id'] ? "selected" : null !!}>
                                            {!! $hk->kode_hak!!} - {!! $hk->nama_hak !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select class="form-control select2" id="kategori" name="kategori_id"
                                        style="width: 100%;">
                                    @foreach($kategori as $kr)
                                        <option value="{{$kr->kategori_id}}"
                                            {!! $kr->kategori_id === $data['ruangan_kategori_id'] ? "selected" : null !!}>
                                            {!! $kr->kode_kategori!!} - {!! $kr->nama_kategori !!}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control">
                                    {{$data['deskripsi_ruangan']}}
                                </textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="button" id="btn-submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="{{url('ruangan')}}" type="button" class="btn btn-sm btn-success">Kembali</a>
                </div>
            </form>
        </div>

    </div>
    <script>
        $(function () {
            $('#hak').select2();
            $('#kategori').select2();

            $("#btn-submit").on('click', function () {
                $("#form-edit").submit();
            });
            $('#form-edit').validate({
                rules: {
                    kode: {
                        required: true,
                        remote: {
                            url: "{{url('ruangan/validasi')}}",
                            type: "POST",
                            data: {
                                _token: "{{csrf_token()}}",
                                id: {{$data['ruangan_id']}},
                                kode: function () {
                                    return $('#kode').val();
                                },
                            }
                        }
                    },
                    nama: {
                        required: true,
                    },
                    kapasitas: {
                        number: true,
                    },
                },
                messages: {
                    kode: {
                        required: "Silahkan masukkan kode",
                        remote: "Kode sudah digunakan."
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
