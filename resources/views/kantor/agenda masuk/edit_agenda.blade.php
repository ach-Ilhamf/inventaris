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
                        <!-- Modal Tambah Barang -->
                        <div tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Edit Kegiatan Masuk</h5>
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
                                        <form action="{{ route('agendas.update', $agenda->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <label for="namaBarang" class="form-label">Nama Kegiatan</label>
                                                <input type="text" class="form-control" id="namaBarang"
                                                    name="nama_agenda" placeholder="Nama Kegiatan"
                                                    value="{{ old('agenda_masuk', $agenda->nama_agenda) }}" required>
                                            </div>
                                            <!-- Input untuk Lokasi -->
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Penyedia</label>
                                                        <select class="form-control" id="penyedia" name="id_penyedia"
                                                            required>
                                                            @foreach($penyediaList as $penyedia)
                                                            <option value="{{ $penyedia->id }}" {{ $agenda->id_penyedia == $penyedia->id ? 'selected' : '' }}>
                                                                {{ $penyedia->nama }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Nilai Kontrak</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="nilai_kontrak" placeholder="Nilai Kontrak"
                                                            value="{{ old('agenda_masuk', $agenda->nilai_kontrak) }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Klasifikasi Aset</label>
                                                <input type="text" class="form-control" id="lokasi" name="klas_aset"
                                                    placeholder="Klasifikasi Aset"
                                                    value="{{ old('agenda_masuk', $agenda->klas_aset) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tanggal Masuk</label>
                                                <input type="date" class="form-control" id="lokasi" name="tgl_masuk"
                                                    placeholder="Tanggal Masuk"
                                                    value="{{ old('agenda_masuk', $agenda->tgl_masuk) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No SKP/SP</label>
                                                <input type="text" class="form-control" id="lokasi" name="skp"
                                                    placeholder="No SKP/SP"
                                                    value="{{ old('agenda_masuk', $agenda->skp) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No BAHP/BAPPHP</label>
                                                        <input type="text" class="form-control" id="lokasi" name="bahp"
                                                            placeholder="No BAPH/BAPPHP"
                                                            value="{{ old('agenda_masuk', $agenda->bahp) }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal
                                                            BAPH/BAPPHP</label>
                                                        <input type="date" class="form-control" id="lokasi"
                                                            name="tgl_bahp" placeholder="Tanggal BAHP/BAPPHP"
                                                            value="{{ old('agenda_masuk', $agenda->tgl_bahp) }}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No BAST</label>
                                                        <input type="text" class="form-control" id="lokasi" name="bast"
                                                            placeholder="No BAST"
                                                            value="{{ old('agenda_masuk', $agenda->bast) }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal BAST</label>
                                                        <input type="date" class="form-control" id="lokasi"
                                                            name="tgl_bast" placeholder="Tanggal BAST"
                                                            value="{{ old('agenda_masuk', $agenda->tgl_bast) }}"
                                                            required>
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
                                                    value="{{ old('agenda_masuk', $agenda->Keterangan) }}"
                                                    placeholder="Keterangan">
                                            </div>
                                            <!-- Tombol untuk menyimpan data -->
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Mengedit Kegiatan ?');" type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

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
