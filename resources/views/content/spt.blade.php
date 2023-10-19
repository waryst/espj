@extends('layout.main')
@section('title', 'Daftar SPT')
@push('mycss')
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet"
        href="{{ asset('asset') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
@endpush

@section('content')
    <div class="content">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Surat Perintah Tugas</h3>
            </div>
            <div class="card-body">
                <div class="pull-right">
                    <button type="button" class="btn btn-primary my-3 " data-toggle="modal" data-target="#modal-lg"><i
                            class="fas fa-plus"></i>
                        Surat Perintah Tugas (SPT)</button>
                </div>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 2%">No</th>
                            <th>Judul</th>
                            <th class="text-center" style="width: 12%">Tanggal</th>
                            <th class="text-center" style="width: 17%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($spts as $spt)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                <td>{{ $spt->judul }}. Tanggal :
                                    @if ($spt->pulang == $spt->berangkat)
                                        {{ Illuminate\Support\Carbon::parse($spt->berangkat)->isoFormat('DD MMMM Y') }}
                                    @else
                                        {{ Illuminate\Support\Carbon::parse($spt->berangkat)->isoFormat('DD MMMM Y') }}
                                        s/d
                                        {{ Illuminate\Support\Carbon::parse($spt->pulang)->isoFormat('DD MMMM Y') }}
                                    @endif
                                    <br>
                                    <a class="text-bold" data-toggle="collapse" href="#detail-{{ $loop->iteration }}"
                                        role="button" aria-expanded="false" aria-controls="detail-1">
                                        Menugaskan :
                                    </a>
                                    <div class="collapse" id="detail-{{ $loop->iteration }}">
                                        <ol>
                                            @foreach ($spt->pegawaispt as $pegawaispt)
                                                <li>{{ $pegawaispt->pegawai->gelar_depan . ' ' . strtoupper($pegawaispt->pegawai->nama) . ' ' . $pegawaispt->pegawai->gelar_belakang }}
                                                </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                    {{ Illuminate\Support\Carbon::parse($spt->tgl)->isoFormat('DD MMMM Y') }}</td>
                                <td class="text-center align-middle">
                                    <button type="button" class="badge btn-info btn-sm p-1" data-toggle="modal"
                                        data-target="#modal-lg">
                                        <svg class="svg" height="1em" viewBox="0 0 512 512">
                                            <path
                                                d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                        </svg>Edit</button>
                                    <button type="button" class="badge btn-danger btn-sm p-1"
                                        onclick="show_nomer('{{ $spt->id }}')">
                                        <svg class="svg px-1" height="1em" viewBox="0 0 448 512">
                                            <path
                                                d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                                        </svg>
                                        Del
                                    </button>

                                    <button type="button" class="badge btn-primary btn-sm p-1"
                                        onclick="show_nomer('{{ $spt->id }}')">
                                        <svg class="svg" height="1em" viewBox="0 0 576 512">
                                            <style>
                                                .svg {
                                                    fill: #F5F9F9
                                                }
                                            </style>

                                            <path
                                                d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                        </svg>
                                        SPT
                                    </button>
                                    <button type="button" class="btn btn-success btn-block btn-sm m-1"
                                        onclick="show_nomer('{{ $spt->id }}')">
                                        SPPD
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal-lg" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buat Surat Perintah Tugas (SPT)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row px-2 py-0 m-0">
                    <div class="card col-sm-6">
                        <div class="card-body p-0">
                            <div class="form-group">
                                <label for="exampleInputEmail1">No. Surat</label>
                                <input type="text" autocomplete="off" name="no_surat" id="no_surat"
                                    class="form-control form-control-sm col-sm-8" value="090/       /405.19/2023">
                                <span class="text-danger" id="no_suratError"></span>
                            </div>
                            <div class="form-group">
                                <label for="judul">Kegiatan</label>
                                <textarea class="form-control" name="judul" id="judul" rows="3" placeholder=""></textarea>
                                <span class="text-danger" id="judulError"></span>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="reservation" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card col-sm-6">
                        <div class="card-body p-0">

                            <form method="post" id="add_pegawai">
                                <div class="form-group">
                                    <label>Tanggal SPT</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="tgl_spt" id="tgl_spt" value="{{ $tgl_sekarang }}"
                                            class="form-control datetimepicker-input" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Penandatangan</label>
                                    <div class="input-group">
                                        <select class="form-control select2" name="penandatangan" style="width:100%">
                                            @foreach ($penandatangans as $penandatangan)
                                                <option value="{{ $penandatangan->id }}">
                                                    {{ strtoupper($penandatangan->jabatan) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Menugaskan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                        <tr>
                                            <td class="px-0  py-1" width=100%>
                                                <select class="form-control select2" name="pegawai[]" style="width:100%">
                                                    @foreach ($pegawais as $pegawai)
                                                        <option value="{{ $pegawai->id }}">
                                                            {{ strtoupper($pegawai->nama) }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </td>
                                            <td class="text-center p-1"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <button class="btn btn-sm btn-primary my-3 float-right" id="add-input">Tambah</button>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between p-0">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" name="simpan" id="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </div>


        </div>
    @endsection




    @push('java')
        <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/jszip/jszip.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/pdfmake/pdfmake.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/pdfmake/vfs_fonts.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/moment/moment.min.js"></script>
        <script src="{{ asset('asset') }}/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="{{ asset('asset') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

        <script src="{{ asset('asset') }}/id.js"></script>


        <script>
            $(document).ready(function() {

                $("#simpan").click(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var data = $('#add_pegawai').serializeArray();
                    data.push({
                        name: 'no_surat',
                        value: $('#no_surat').val()
                    });
                    data.push({
                        name: 'judul',
                        value: $('#judul').val()
                    });
                    data.push({
                        name: 'berangkat',
                        value: $('#tgl').attr('data-start')
                    });
                    data.push({
                        name: 'pulang',
                        value: $('#tgl').attr('data-end')
                    });
                    data.push({
                        name: 'tgl_spt',
                        value: tglspt()
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('spt/simpan') }}",
                        data: data,
                        dataType: 'json',
                        success: function(data) {
                            window.location = data.url;
                        },
                        error: function(data) {
                            $('#no_suratError').addClass('d-none');
                            $('#judulError').addClass('d-none');
                            var errors = data.responseJSON;
                            if ($.isEmptyObject(errors) == false) {
                                $.each(errors.errors, function(key, value) {
                                    var ErrorID = '#' + key + 'Error';
                                    $(ErrorID).removeClass("d-none");
                                    $(ErrorID).text(value);
                                })
                            }
                        }
                    })
                })
            })
            let dataRow = 1
            $('#add-input').click(() => {
                dataRow++
                inputRow(dataRow)
                $(".select2").select2();

            })

            inputRow = (i) => {
                let tr = `<tr id="input-tr-${i}">
                        <td class="px-0 py-1">
                            <select class="form-control select2" name="pegawai[]" style="width:100%">
                                @foreach ($pegawais as $pegawai)
                                     <option value="{{ $pegawai->id }}">{{ strtoupper($pegawai->nama) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center px-1 py-1">
                            <button class="btn btn-sm btn-danger delete-record float-end" data-id="${i}"><i class="far fa-trash-alt"></i></button>
                        </td>
                    </tr>`
                $('#data').append(tr)
            }

            $('#data').on('click', '.delete-record', function() {
                let id = $(this).attr('data-id')
                $('#input-tr-' + id).remove()
            })

            $(document).ready(function() {

                $("#reservation").daterangepicker({
                    drops: 'up',

                });
            });

            function show_nomer(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('word') }}/" + id,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.open(data.download, '_blank')
                    },
                    error: function(data) {}
                });

            }
            $(function() {
                $("#reservationdate").datetimepicker({
                    locale: 'id',
                    format: "DD MMM YYYY",
                });
                $(".select2").select2();

                $('#example1').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });

            function tglspt() {
                let arr = [{
                        name: "Jan",
                        value: "01",
                    },
                    {
                        name: "Feb",
                        value: "02",
                    }, {
                        name: "Mar",
                        value: "03",
                    }, {
                        name: "Apr",
                        value: "04",
                    }, {
                        name: "Mei",
                        value: "05",
                    }, {
                        name: "Jun",
                        value: "06",
                    }, {
                        name: "Jul",
                        value: "07",
                    }, {
                        name: "Agt",
                        value: "08",
                    }, {
                        name: "Sep",
                        value: "09",
                    }, {
                        name: "Okt",
                        value: "10",
                    }, {
                        name: "Nov",
                        value: "11",
                    }, {
                        name: "Des",
                        value: "12",
                    }
                ];
                var explode = $('#tgl_spt').val().split(" ");
                let obj = arr.find(o => o.name === explode[1]);
                return (explode[2] + '-' + obj.value + '-' + explode[0]);
            }
        </script>
    @endpush
