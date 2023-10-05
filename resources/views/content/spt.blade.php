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
@endpush

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Surat Perintah Tugas</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 2%">No</th>
                            <th>Judul</th>
                            <th class="text-center" style="width: 15%">Tanggal</th>
                            <th class="text-center" style="width: 10%">Jenis</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle">1</td>
                            <td>Konsultasi dan Koordinasi terkait Replikasi Aplikasi/Sistem Informasi ke Dinas Komunikasi
                                dan Informatika Pemerintah Provinsi Jawa Timur, Jl. A Yani 242-244. Tanggal : 07 Agustus
                                2023
                                <br>
                                <a class="text-bold" data-toggle="collapse" href="#detail-1" role="button"
                                    aria-expanded="false" aria-controls="detail-1">
                                    Menugaskan :
                                </a>
                                <div class="collapse" id="detail-1">

                                    <ol>
                                        <li>HANDI SETYAWAN, S.Kom., M.Si.</li>
                                        <li>ERLIYAH NURUL JANNAH, S.Kom.</li>
                                        <li>RICKY ROMDHONI, A.Md.</li>
                                    </ol>
                                </div>
                            </td>
                            <td class="text-center align-middle">02 Agustus 2023</td>
                            <td class="text-center align-middle">Luar Daerah</td>
                            <td class="text-center align-middle"> 4</td>

                        </tr>
                    </tbody>
                </table>
            </div>
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
    <script>
        $(function() {
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
    </script>
@endpush
