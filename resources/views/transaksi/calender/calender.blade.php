@extends('template.base')
@section('title','Dashboard')
@section('description','Dashboard')
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
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kalender</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Peminjaman</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form id="form-tambah" method="post" action="{{url('pinjam-ruangan')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg">
                                            <div class="form-group">
                                                <label for="hak">Ruangan</label>
                                                <select class="form-control select2" id="ruangan" name="ruangan"
                                                        style="width: 100%;">
                                                    <option value=""></option>
                                                    @foreach($ruangan as $rk)
                                                        <option value="{{$rk->ruangan_id}}">{!! $rk->kode_ruangan!!}
                                                            - {!! $rk->nama_ruangan !!}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggalAwal">Tanggal Awal</label>
                                                <input type="date" name="tanggalAwal" class="form-control"
                                                       id="tanggalAwal">
                                                <input type="hidden" name="user" value="{{$session['user_id']}}"
                                                       id="user">
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggalAkhir">Tanggal Berakhir</label>
                                                <input type="date" name="tanggalAkhir" class="form-control"
                                                       id="tanggalAkhir">
                                            </div>
                                            <div class="form-group">
                                                <label for="jamMulai">Jam Mulai</label>
                                                <input type="time" name="jamMulai" class="form-control" id="jamMulai">
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="jamBerakhir">Jam Berakhir</label>
                                                    <input type="time" name="jamBerakhir" class="form-control"
                                                           id="jamBerakhir">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="kegiatan">Kegiatan</label>
                                                    <input type="text" name="kegiatan" class="form-control"
                                                           id="kegiatan">
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

                                <button type="submit" id="btn-submit" class="btn btn-sm btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function () {
            $("#ruangan").select2({
                    placeholder: "Pilih Ruangan"
                }
            );

            $("#btn-submit").on('click', function (event) {
                event.preventDefault();

                let validate = $("#form-tambah").valid();
                if (validate) {
                    $("#form-tambah").submit();
                }

            });

            $('#form-tambah').validate({
                rules: {
                    ruangan: {
                        required: true,
                    },
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
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth",
                events: [
                        <?php
                        $data = \App\Model\Peminjaman::getKalender();
                        foreach ($data as $d){ ?>
                    {
                        title: '<?php echo $d->peminjaman_kegiatan . " - " . $d->nama_ruangan . " " . $d->kode_ruangan ?>',
                        start: '<?php echo $d->peminjaman_tgl_awal; ?>',
                        // end: '2022-04-28',
                        end: new Date(new Date('<?php echo $d->peminjaman_tgl_akhir; ?>').setDate(new Date('<?php echo $d->peminjaman_tgl_akhir; ?>').getDate()))
                    },
                    <?php } ?>
                ],
                timeFormat: 'H(:mm)', // uppercase H for 24-hour clock、
                displayEventTime: false,
                selectOverlap: function (event) {
                    return event.rendering === 'background';
                },
                eventClick: function (info) {
                    swal('Event: ' + info.event.title);
                    // change the border color just for fun
                    // info.el.style.borderColor = 'red';
                },
            });

            calendar.render();
        });
    </script>
@endsection
