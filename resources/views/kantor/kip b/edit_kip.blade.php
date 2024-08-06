<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum=1.0" />
    <title>Edit Barang KIP-B</title>
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
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Edit Barang</h5>
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
                                        <form action="{{ route('kipbs.update', $kipb->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Kode Barang</label>
                                                        <select class="form-control" id="penyedia" name="kode_barang"
                                                            required>
                                                            @foreach($kodes as $kode)
                                                            <option value="{{ $kode->kode_barang }}">
                                                                {{ $kode->kode_barang }} - {{ $kode->jenis_barang }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Jenis Barang</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="nama_barang" placeholder="Jenis Barang" value="{{ old('kipb', $kipb->nama_barang) }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Register</label>
                                                        <input type="text" class="form-control" id="lokasi" name="no_register"
                                                            placeholder="No Register" value="{{ old('kipb', $kipb->no_register) }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="penyedia" class="form-label">Nama Pegawai</label>
                                                        <select class="form-control" id="penyedia" name="id_pegawai"
                                                            required>
                                                            @foreach($pegawaiList as $pegawai)
                                                            <option value="{{ $pegawai->id }}" {{ $kipb->id_pegawai == $pegawai->id ? 'selected' : '' }}>
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
                                                        <label for="lokasi" class="form-label">Merk</label>
                                                        <input type="text" class="form-control" id="lokasi" name="merk"
                                                            placeholder="Merk" value="{{ old('kipb', $kipb->merk) }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Type</label>
                                                        <input type="text" class="form-control" id="lokasi" name="tipe"
                                                            placeholder="Type" value="{{ old('kipb', $kipb->tipe) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Ukuran</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="ukuran" placeholder="Ukuran" value="{{ old('kipb', $kipb->ukuran) }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Bahan</label>
                                                        <input type="text" class="form-control" id="lokasi" name="merk"
                                                            placeholder="Bahan" value="{{ old('kipb', $kipb->bahan) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tahun Beli</label>
                                                <input type="text" class="form-control" id="lokasi" name="tahun_beli"
                                                    placeholder="Tahun Beli" value="{{ old('kipb', $kipb->tahun_beli) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No Pabrik</label>
                                                <input type="text" class="form-control" id="lokasi" name="no_pabrik"
                                                    placeholder="No Pabrik" value="{{ old('kipb', $kipb->no_pabrik) }}">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Rangka</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_rangka" placeholder="No Rangka" value="{{ old('kipb', $kipb->no_rangka) }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Mesin</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_mesin" placeholder="No Mesin" value="{{ old('kipb', $kipb->no_mesin) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Polisi</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_polisi" placeholder="No Polisi" value="{{ old('kipb', $kipb->no_mesin) }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No BPKB</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_bpkb" placeholder="No BPKB" value="{{ old('kipb', $kipb->no_bpkb) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Asal Usul</label>
                                                <input type="text" class="form-control" id="lokasi" name="asal_usul"
                                                    placeholder="Asal Usul" value="{{ old('kipb', $kipb->asal_usul) }}">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="harga_satuan" placeholder="Harga" value="{{ old('kipb', $kipb->harga_satuan) }}" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Beban Susut</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="beban_susut" placeholder="Beban Susut" value="{{ old('kipb', $kipb->beban_susut) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Nilai Buku</label>
                                                <input type="number" class="form-control" id="lokasi" name="nilai_buku"
                                                    placeholder="Nilai Buku" value="{{ old('kipb', $kipb->nilai_buku) }}">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Kondisi</label>
                                                        <select class="form-control" id="lokasi" name="kondisi"
                                                            required>
                                                            <option value="">Pilih Kondisi</option>
                                                            <option value="BAIK">BAIK</option>
                                                            <option value="KURANG BAIK">KURANG BAIK</option>
                                                            <option value="RUSAK BERAT">RUSAK BERAT</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Lokasi</label>
                                                        <select class="form-control" id="lokasi" name="lokasi" required>
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
                                                </div>
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
