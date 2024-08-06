<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum=1.0" />
    <title>Edit Penerimaan Barang Pakai Habis</title>
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
                                        <form action="{{ route('barangterimas.update', $terima->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="namaBarang" class="form-label">Kode Barang</label>
                                                        <input type="text" class="form-control" id="namaBarang" name="kode_barang"
                                                            placeholder="Kode Barang" value="{{ old('baranghabisterimas', $terima->kode_barang)}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Jenis Barang</label>
                                                        <select class="form-control" id="penyedia" name="id_barang" }
                                                            required>
                                                            @foreach($barangList as $barang)
                                                            <option value="{{ $barang->id }}" {{ $terima->id_barang == $barang->id ? 'selected' : '' }}>
                                                                {{ $barang->jenis_barang }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tanggal Terima Barang</label>
                                                <input type="date" class="form-control" id="lokasi" name="tgl_terima"
                                                    placeholder="Tanggal Terima Barang" value="{{ old('baranghabisterimas', $terima->tgl_terima)}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal SPK/perjanjian/Kontrak</label>
                                                        <input type="date" class="form-control" id="lokasi" name="tgl_spk"
                                                            placeholder="Tanggal SPK/Perjanjian/Kontrak" value="{{ old('baranghabisterimas', $terima->tgl_spk)}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No SPK/perjanjian/Kontrak</label>
                                                        <input type="text" class="form-control" id="lokasi" name="no_spk"
                                                            placeholder="No SPK/Perjanjian/Kontrak" value="{{ old('baranghabisterimas', $terima->no_spk)}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Tanggal DPA/SPM/Kwitansi</label>
                                                        <input type="date" class="form-control" id="lokasi" name="tgl_dpa"
                                                            placeholder="Tanggal DPA/SPM/Kwitansi" value="{{ old('baranghabisterimas', $terima->tgl_dpa)}}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No DPA/SPM/Kwitansi</label>
                                                        <input type="text" class="form-control" id="lokasi" name="no_dpa"
                                                            placeholder="No DPA/SPM/Kwitansi" value="{{ old('baranghabisterimas', $terima->no_dpa)}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Banyak Barang</label>
                                                        <input type="number" class="form-control" id="lokasi" name="banyak_barang"
                                                            placeholder="Banyak Barang" value="{{ old('baranghabisterimas', $terima->banyak_barang)}}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Harga Satuan</label>
                                                        <input type="number" class="form-control" id="lokasi" name="harga_satuan"
                                                            placeholder="Harga Satuan" value="{{ old('baranghabisterimas', $terima->harga_satuan)}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Dipergunakan Pada Unit</label>
                                                        <select class="form-control" id="lokasi" name="unit" required>
                                                            <option value="">Pilih Lokasi</option>
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
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Keterangan</label>
                                                        <input type="text" class="form-control" id="lokasi" name="keterangan"
                                                            placeholder="Keterangan" value="{{ old('baranghabisterimas', $terima->keterangan)}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Tombol untuk menyimpan data -->
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Mengedit Penerimaan Barang ?');" type="submit" class="btn btn-primary">Simpan</button>
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
