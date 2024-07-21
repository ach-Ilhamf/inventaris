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
                        <h3>Barang KIP-B</h3>
                        <!-- Pencarian -->
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" id="search" class="form-control"
                                    placeholder="Cari berdasarkan nama atau ID barang...">
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
                                        <h5 class="modal-title" id="modalTambahBarangLabel">Tambah Barang</h5>
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
                                        <form action="{{ route('kipbs.store') }}" method="POST">
                                            @csrf
                                            <!-- Input untuk nama barang -->
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="namaBarang" class="form-label">Kode Barang</label>
                                                        <input type="text" class="form-control" id="namaBarang"
                                                            name="kode_barang" placeholder="Kode Barang" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Jenis Barang</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="jenis_barang" placeholder="Jenis Barang" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No Register</label>
                                                <input type="text" class="form-control" id="lokasi" name="no_register"
                                                    placeholder="no_register" required>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Merk</label>
                                                        <input type="text" class="form-control" id="lokasi" name="merk"
                                                            placeholder="Merk">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Type</label>
                                                        <input type="text" class="form-control" id="lokasi" name="type"
                                                            placeholder="Type">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Ukuran</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="ukuran" placeholder="Ukuran">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Bahan</label>
                                                        <input type="text" class="form-control" id="lokasi" name="merk"
                                                            placeholder="Merk">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Tahun Beli</label>
                                                <input type="text" class="form-control" id="lokasi" name="tahun_beli"
                                                    placeholder="Tahun Beli" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">No Pabrik</label>
                                                <input type="text" class="form-control" id="lokasi" name="no_pabrik"
                                                    placeholder="No Pabrik">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Rangka</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_rangka" placeholder="No Rangka">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Mesin</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_mesin" placeholder="No Mesin">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No Polisi</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_polisi" placeholder="No Polisi">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">No BPKB</label>
                                                        <input type="text" class="form-control" id="lokasi"
                                                            name="no_bpkb" placeholder="No BPKB">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Asal Usul</label>
                                                <input type="text" class="form-control" id="lokasi" name="asal_usul"
                                                    placeholder="Asal Usul">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Harga</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="harga" placeholder="Harga" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Beban Susut</label>
                                                        <input type="number" class="form-control" id="lokasi"
                                                            name="beban_susut" placeholder="Beban Susut" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Nilai Buku</label>
                                                <input type="number" class="form-control" id="lokasi" name="nilai_buku"
                                                    placeholder="Nilai Buku">
                                            </div>
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="lokasi" class="form-label">Kondisi</label>
                                                        <select class="form-control" id="lokasi" name="kondisi" required>
                                                            <option value="">Pilih Kondisi</option>
                                                            <option value="RUSAK BERAT">RUSAK BERAT</option>
                                                            <option value="KURANG BAIK">KURANG BAIK</option>
                                                            <option value="BAIK">BAIK</option>
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
                                            <!-- Tombol untuk menyimpan data -->
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Barang -->
                        <div class="card">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Kode Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>No Register</th>
                                            <th>Merk</th>
                                            <th>Type</th>
                                            <th>Ukuran</th>
                                            <th>Bahan</th>
                                            <th>Tahun Beli</th>
                                            <th>No Pabrik</th>
                                            <th>No Rangka</th>
                                            <th>No Mesin</th>
                                            <th>No Polisi</th>
                                            <th>No BPKB</th>
                                            <th>Asal Usul</th>
                                            <th>Harga</th>
                                            <th>Beban Susut</th>
                                            <th>Akumulasi Penyusutan</th>
                                            <th>Nilai Buku</th>
                                            <th>Kondisi</th>
                                            <th>Lokasi</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="table-body">
                                        @forelse ($kipbs as $kipb)
                                        <tr>
                                            <td>{{ $kipb->kode_barang }}</td>
                                            <td>{{ $kipb->jenis_barang }}</td>
                                            <td>{{ $kipb->no_register }}</td>
                                            <td>{{ $kipb->merk }}</td>
                                            <td>{{ $kipb->type }}</td>
                                            <td>{{ $kipb->ukuran }}</td>
                                            <td>{{ $kipb->bahan }}</td>
                                            <td>{{ $kipb->tahun_beli }}</td>
                                            <td>{{ $kipb->no_pabrik }}</td>
                                            <td>{{ $kipb->no_rangka }}</td>
                                            <td>{{ $kipb->no_mesin }}</td>
                                            <td>{{ $kipb->no_polisi }}</td>
                                            <td>{{ $kipb->no_bpkb }}</td>
                                            <td>{{ $kipb->asal_usul }}</td>
                                            <td>Rp. {{ number_format($kipb->harga, 2, ',', '.') }}</td>
                                            <td>{{ $kipb->beban_susut }}</td>
                                            <td>Rp. {{ number_format($kipb->harga + $kipb->beban_susut, 2, ',', '.') }}</td>
                                            <td>{{ $kipb->nilai_buku }}</td>
                                            <td>{{ $kipb->kondisi }}</td>
                                            <td>{{ $kipb->lokasi }}</td>
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                                    action="{{ route('kipbs.destroy', $kipb->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('kipbs.edit', $kipb->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="13" class="text-center">Data Barang Belum Tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{ $kipbs->links() }}
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
