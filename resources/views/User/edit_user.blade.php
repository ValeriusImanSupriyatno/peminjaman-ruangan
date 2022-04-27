@extends('template.base')
@section('title','User')
@section('description','Ubah User')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah User</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="col-md-6">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Tambah</h3>
            </div>


            <form id="form-edit" action="{{url('user/'.$user['user_id'])}}" method="GET">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$user['name']}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{$user['username']}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="form-group">
                        <label for="akses">Akses</label>
                        <select class="custom-select rounded-0" name="akses" id="akses">
                            <option {{$user['role'] === 'user' ? 'selected' :''}} value="user">User</option>
                            <option {{$user['role'] === 'admin' ? 'selected' :''}} value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="button" id="btn-submit" class="btn btn-sm btn-primary">Simpan</button>
                    <a href="{{url('user')}}" type="button" class="btn btn-sm btn-success">Kembali</a>
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
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        minlength: 5
                    },
                    name: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "Silahkan masukkan alamat email",
                        email: "silahkan isi dengan format email"
                    },
                    password: {
                        minlength: "Kata sandi Anda harus minimal 5 karakter"
                    },
                    name: {
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
