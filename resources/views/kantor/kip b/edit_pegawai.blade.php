<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum=1.0" />
    <title>Edit Pegawai</title>
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
                        <div tabindex="-1" aria-labelledby="modalTambahBarangLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Edit Pegawai</h5>
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
                                        <form action="{{ route('pegawais.update', $pegawai->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <label for="namaBarang" class="form-label">Nama Pegawai</label>
                                                <input type="text" class="form-control" id="namaBarang" name="nama_pegawai"
                                                    placeholder="Nama Pegawai" value="{{ old('pegawai', $pegawai->nama_pegawai)}}" required>
                                            </div>
                                            <!-- Input untuk Lokasi -->
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">NIP</label>
                                                <input type="text" class="form-control" id="lokasi" name="nip"
                                                    placeholder="NIP" value="{{ old('pegawai', $pegawai->nip)}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Unit</label>
                                                <select class="form-control" id="lokasi" name="unit" required>
                                                    <option value="">Pilih Unit</option>
                                                    <option value="Kepala Dinas">Kepala Dinas</option>
                                                    <option value="Sekretariat">Sekretariat</option>
                                                    <option value="Sekretaris">Sekretaris</option>
                                                    <option value="Bidang TI">Bidang TI</option>
                                                    <option value="Bidang SIB">Bidang SIB</option>
                                                    <option value="Bidang SPBE">Bidang SPBE</option>
                                                    <option value="Ruang Rapat">Ruang Rapat</option>
                                                    <option value="Radio">Radio</option>
                                                    <option value="Call Center">Call Center</option>
                                                    <option value="Server Kominfo">Server Kominfo</option>
                                                </select>
                                            </div>                                            <!-- Tombol untuk menyimpan data -->
                                            <!-- Tombol untuk menyimpan data -->
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Mengedit Pegawai ?');" type="submit" class="btn btn-primary">Simpan</button>
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
