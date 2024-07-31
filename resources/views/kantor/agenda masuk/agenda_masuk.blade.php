<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum=1.0" />
    <title>Dashboard - Kantor</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Page CSS -->
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('partials.aside')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h3>Kegiatan Masuk</h3>
                        <!-- Pencarian -->
                        <div class="row mb-3">
                            <div class="col">
                            </div>
                            <div class="col text-end">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#modalImport">Impor Data</button>
                                <a href="../../controller/export.php" class="btn btn-success">Export Data</a>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahBarang">Tambah Kegiatan Masuk</button>
                            </div>
                        </div>

                        <!-- Modal import data -->
                        <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalImportLabel">Import Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input class="form-control" type="file" name="file_excel"
                                                accept=".xlsx,.xls">
                                            <button type="submit" class="btn btn-primary mt-3"
                                                name="Import">Import</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Tambah Barang -->
                        <div class="modal fade" id="modalTambahBarang" tabindex="-1"
                            aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Kegiatan Masuk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="modal-body">
                                        <form action="{{ route('agendas.store') }}" method="POST">
                                            @csrf
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <label for="namaBarang" class="form-label">Nama Kegiatan</label>
                                                <input type="text" class="form-control" id="namaBarang"
                                                    name="nama_agenda" placeholder="Nama Kegiatan" required>
                                            </div>
                                            <!-- Input untuk Lokasi -->
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Penyedia</label>
                                                        <select class="form-control" id="penyedia" name="id_penyedia"
                                                            required>
                                                            @foreach($penyediaList as $penyedia)
                                                            <option value="{{ $penyedia->id }}">
                                                                {{ $penyedia->nama }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Nilai Kontrak</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="nilai_kontrak" placeholder="Nilai Kontrak" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Klasifikasi Aset</label>
                                                <input type="text" class="form-control" id="lokasi" name="klas_aset"
                                                    placeholder="Klasifikasi Aset" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tanggal Masuk</label>
                                                <input type="date" class="form-control" id="lokasi" name="tgl_masuk"
                                                    placeholder="Tanggal Masuk" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No SPK/SP</label>
                                                <input type="text" class="form-control" id="lokasi" name="skp"
                                                    placeholder="No SKP/SP" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No BAHP/BAPPHP</label>
                                                        <input type="text" class="form-control" id="lokasi" name="bahp"
                                                            placeholder="No BAPH/BAPPHP" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal
                                                            BAPH/BAPPHP</label>
                                                        <input type="date" class="form-control" id="lokasi"
                                                            name="tgl_bahp" placeholder="Tanggal BAHP/BAPPHP" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No BAST</label>
                                                        <input type="text" class="form-control" id="lokasi" name="bast"
                                                            placeholder="No BAST" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal BAST</label>
                                                        <input type="date" class="form-control" id="lokasi"
                                                            name="tgl_bast" placeholder="Tanggal BAST" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Dokumen</label>
                                                <select class="form-control" id="lokasi" name="dokumen">
                                                    <option value="">Pilih Dokumen</option>
                                                    <option value="Lengkap">Lengkap</option>
                                                    <option value="Tidak Lengkap">Tidak Lengkap</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Keterangan</label>
                                                <input type="text" class="form-control" id="lokasi" name="Keterangan"
                                                    placeholder="Keterangan">
                                            </div>
                                            <!-- Tombol untuk menyimpan data -->
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Menambah Kegiatan ?');" type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nama_agenda" id="filter-nama-agenda" placeholder=" Filter Nama Kegiatan">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="penyedia" id="filter-penyedia" placeholder="Filter Penyedia">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nilai_kontrak" id="filter-nilai-kontrak" placeholder="Filter Nilai Kontrak">
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger" id="error-alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session('success'))
                        <div class="alert alert-success" id="success-alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Tabel Barang -->
                        <div class="card">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped" id='agenda_table'>
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nama Agenda</th>
                                            <th>Penyedia</th>
                                            <th>Nilai Kontrak</th>
                                            <th>Tanggal Masuk</th>
                                            <th>No SKP</th>
                                            <th>No BAHP</th>
                                            <th>Tanggal BAHP</th>
                                            <th>No BAST</th>
                                            <th>Tanggal BAST</th>
                                            <th>Dokumen</th>
                                            <th>Keterangan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#agenda_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('agendas.data') }}',
                    type: 'GET',
                    data: function(d) {
                        d.nama_agenda = $('#filter-nama-agenda').val();
                        d.penyedia = $('#filter-penyedia').val();
                        d.nilai_kontrak = $('#filter-nilai-kontrak').val();
                    }
                },
                columns: [
                    { data: 'nama_agenda', name: 'nama_agenda' },
                    { data: 'penyedia.nama', name: 'penyedia.nama' },
                    { data: 'nilai_kontrak', name: 'nilai_kontrak', render: function(data, type, row) {
                        return 'Rp ' + parseInt(data).toLocaleString('id-ID');} },
                    { data: 'tgl_masuk', name: 'tgl_masuk' },
                    { data: 'skp', name: 'skp' },
                    { data: 'bahp', name: 'bahp' },
                    { data: 'tgl_bahp', name: 'tgl_bahp' },
                    { data: 'bast', name: 'bast' },
                    { data: 'tgl_bast', name: 'tgl_bast' },
                    { data: 'dokumen', name: 'dokumen' },
                    { data: 'Keterangan', name: 'Keterangan' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#filter-nama-agenda, #filter-penyedia, #filter-nilai-kontrak').on('keyup change', function() {
                table.draw();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#success-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
    
                $("#error-alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 3000); 
        });
    </script>
    