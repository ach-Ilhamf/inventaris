<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum=1.0" />
    <title>Edit Barang Kegiatan Masuk</title>
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
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Edit Barang Kegiatan {{ $agendadtl->agendamasuk->nama_agenda }} </h5>
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
                                        <form action="{{ route('agendadtls.update', $agendadtl->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id_agenda" value="{{ $agendadtl->id_agenda }}">
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $agendadtl->nama_barang) }}" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="penyedia" class="form-label">Nama Pegawai</label>
                                                            <select class="form-control" id="penyedia" name="id_pegawai"
                                                                required>
                                                                @foreach($pegawaiList as $pegawai)
                                                                <option value="{{ $pegawai->id }}" {{ $agendadtl->id_pegawai == $pegawai->id ? 'selected' : '' }}>
                                                                    {{ $pegawai->nama_pegawai }} - {{ $pegawai->unit }} 
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="gambar" class="form-label">Gambar Barang</label>
                                                        @if($agendadtl->gambar)
                                                            <div class="mb-2">
                                                                <img src="{{ asset('storage/gambar/' . $agendadtl->gambar) }}" class="rounded" style="width: 150px">
                                                            </div>
                                                        @endif
                                                        <input type="file" class="form-control" id="gambar" name="gambar">
                                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                                    </div>
                                                    <div class="col">
                                                        <label for="nama_barang" class="form-label">Tahun Beli</label>
                                                        <input type="text" class="form-control" id="nama_barang"
                                                            name="tahun_beli" value="{{ old('nama_barang', $agendadtl->tahun_beli) }}" placeholder="Tahun Beli" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="merk" class="form-label">Merk</label>
                                                        <input type="text" class="form-control" id="merk" name="merk"
                                                            value="{{ old('nama_barang', $agendadtl->merk) }}" placeholder="Merk">
                                                    </div>
                                                    <div class="col">
                                                        <label for="tipe" class="form-label">Tipe</label>
                                                        <input type="text" class="form-control" id="tipe" name="tipe"
                                                            value="{{ old('nama_barang', $agendadtl->tipe) }}" placeholder="Tipe">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="merk" class="form-label">No Rangka</label>
                                                        <input type="text" class="form-control" id="merk" name="no_rangka"
                                                           value="{{ old('nama_barang', $agendadtl->no_rangka) }}" placeholder="No Rangka">
                                                    </div>
                                                    <div class="col">
                                                        <label for="tipe" class="form-label">No Mesin</label>
                                                        <input type="text" class="form-control" id="tipe" name="no_mesin"
                                                            value="{{ old('nama_barang', $agendadtl->no_mesin) }}" placeholder="No Mesin">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="merk" class="form-label">No Polisi</label>
                                                        <input type="text" class="form-control" id="merk" name="no_polisi"
                                                            value="{{ old('nama_barang', $agendadtl->no_polisi) }}" placeholder="No Polisi">
                                                    </div>
                                                    <div class="col">
                                                        <label for="tipe" class="form-label">No BPKB</label>
                                                        <input type="text" class="form-control" id="tipe" name="no_bpkb"
                                                            value="{{ old('nama_barang', $agendadtl->no_bpkb) }}" placeholder="No BPKB">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="satuan" class="form-label">Jumlah Barang</label>
                                                        <input type="number" class="form-control" id="satuan" name="satuan"
                                                            value="{{ old('nama_barang', $agendadtl->satuan) }}" placeholder="Jumlah Barang" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                                        <input type="number" class="form-control" id="harga_satuan"
                                                            value="{{ old('nama_barang', $agendadtl->harga_satuan) }}" name="harga_satuan" placeholder="Harga Satuan" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Lokasi</label>
                                                <select class="form-control" id="lokasi" name="lokasi">
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
                                            <button onclick="return confirm('Apakah Anda Yakin Untuk Mengedit Barang ?');" type="submit" class="btn btn-primary">Simpan</button>
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
