@extends('template.base')
@section('title','Peminjaman')
@section('description','Peminjaman')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Peminjaman</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row" style="margin-left: 0px;margin-right: 0px">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Fasilitas</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-8">
                            <select class="form-control select2" id="fasilitasId" name="fasilitasId"
                                    style="width: 100%;">
                                <option value=""></option>
                                @foreach($fasilitas as $fs)
                                    <option data-nama="{{$fs->nama_fasilitas}}"
                                            value="{{$fs->fasilitas_id}}">
                                        {!! $fs->kode_fasilitas!!} - {!! $fs->nama_fasilitas !!}
                                    </option>
                                @endforeach
                                <input type="hidden" id="namaFasilitas" name="namaFasilitas">
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="button" id="btn-add" class="btn btn-primary">
                                <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                        <div class="col-2">
                            <button type="button" id="btn-proses" class="btn btn-success">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <table id="table-item" class="table">
                        <thead>
                        <tr>
                            <th>Fasilitas</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ruangan</h3>
                </div>
                <div class="card-body">
                    <table id="data-transaksi" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Ruangan</th>
                            <th>Nama Ruangan</th>
                            <th>Hak Milik</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="laporan">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            var data = $("#data-transaksi").DataTable({
                "responsive": true,
                "autoWidth": false,
                "searching": false,
                "aoColumnDefs": [
                    {'bSortable': false, 'aTargets': [0, 1, 2, 3, 4, 5]}
                ]
            });

            $('#fasilitasId').select2({placeholder: "Pilih Fasilitas"}).on("change", function () {
                var optionSelected = $(this).children("option:selected");
                $("#namaFasilitas").val(optionSelected.data("nama"));
            });

            function addItem() {
                let namaFasilitas = $("#namaFasilitas").val();
                let fasilitasId = $("#fasilitasId").val();
                if (namaFasilitas === "") {
                    swal({
                        text: 'Fasilitas Belum Dipilih.',
                        type: 'error'
                    })
                } else {
                    let tr = `<tr data-fasilitas="${fasilitasId}">`;
                    tr += `<td id="fasilitas">${namaFasilitas}</td>`;
                    tr += `<td>`;
                    tr += `<button class="btn btn-xs btn-del-item btn-danger"> <i class="fas fa-trash"></i></button>`;
                    tr += `<input type='hidden' name='id' id='asd' class='cari-id' value='${fasilitasId}'/>`;
                    tr += `</td>`;
                    tr += `</tr>`;
                    $("#table-item tbody").append(tr);
                    $("#fasilitasId").val("").trigger("change");
                    $("#namaFasilitas").val("");
                    $(".btn-del-item").on("click", function () {
                        $(this).parent().parent().remove();
                    });
                }
            }

            $("#btn-add").on("click", function (event) {
                event.preventDefault();
                var bolehTambah = true;
                $('.cari-id').each(function () {
                    var cariId = $(this).val();
                    let fasilitasId = $("#fasilitasId").val();
                    if (parseInt(cariId) === parseInt(fasilitasId)) {
                        bolehTambah = false;
                        swal({
                            text: 'Fasilitas Sudah Dipilih.',
                            type: 'error'
                        })
                    }
                })

                if (bolehTambah) {
                    addItem();
                }
            });

            $("#btn-proses").on('click', function () {
                // prosesTransaksi();

                let rows = $("#table-item tbody tr");
                let itemPinjam = [];
                rows.each(function () {
                    let row = $(this);
                    let item = row.data("fasilitas");
                    itemPinjam.push(item);
                });
                let dataKirim = JSON.stringify(itemPinjam);
                if (itemPinjam.length === 0) {
                    swal({
                        title: 'Fasilitas Belum Dipilih',
                        type: 'error'
                    })
                } else {
                    $.ajax({
                        url: "{{url('pinjam-ruangan/filter')}}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "item_fasiltas": dataKirim,
                            "proses": true
                        },
                        dataType: "JSON",
                        success: function (data) {
                            var baris = '';
                            for (var i = 0; i < data.length; i++) {
                                var url = "{{url('pinjam-ruangan/form')}}";
                                var no = i + 1;
                                baris += "<tr>" +
                                    "<td>" + no + "</td>" +
                                    "<td>" + data[i].kode_ruangan + "</td>" +
                                    "<td>" + data[i].nama_ruangan + "</td>" +
                                    "<td>" + data[i].nama_hak + "</td>" +
                                    "<td>" + data[i].nama_kategori + "</td>" +
                                    "<td>" +
                                    "<a href='" + url + "/" + data[i].ruangan_id + "' class='btn btn-sm btn-info'>" +
                                    "<i class='nav-icon fas fa-eye'></i>" +
                                    "</a>" +
                                    "</td>" +
                                    "</tr>";
                            }
                            $('#laporan').html(baris);
                            if (baris === '') {
                                swal({
                                    title: 'Data Tidak Ada',
                                    type: 'error'
                                })
                            }

                        }
                    });
                }
            });
        });
    </script>
@endsection
