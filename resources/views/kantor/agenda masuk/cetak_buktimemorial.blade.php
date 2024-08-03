<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Kantor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }
        .signature-table {
            width: 40%;
        }
        .signature-left {
            float: left;
            margin-right: 4%;
        }
        .signature-right {
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="margin-top: 15px; margin-right: 15px; margin-bottom: 15px; margin-left: 15px;">                
                <div class="pull-left">
                    <center>
                        <p><b>NOTA BUKTI MEMORIAL</b>
                        <p><b><u>PEROLEHAN ASET TETAP</u></b></p> 
                    </center>
                </div>
            </div>
        </div>
        <p>Berdasarkan bukti-bukti transaksi berkaitan dengan Belanja Modal {{ $agenda->nama_agenda }} sebagaimana terlampir, maka dapat 
            diuraikan hal-hal sebagai berikut :
        </p>
        <table>
            <tr>
                <td>1. </td> <td></td>
                <td>Nomor & Tgl SPK</td>
                <td>:</td>
                <td>{{ $agenda->skp }}, {{ $agenda->tgl_masuk_formatted }}</td>
            </tr>
            <tr>
                <td>2. </td> <td></td>
                <td>Nilai Kontrak</td>
                <td>:</td>
                <td>Rp {{ number_format($agenda->nilai_kontrak, 2, ',', '.') }}</td>
            </tr>
            <tr>
                <td>3. </td> <td></td>
                <td>Nama & Alamat Rekanan</td>
                <td>:</td>
                <td>{{ $agenda->penyedia->nama }}, {{ $agenda->penyedia->alamat }}</td>
            </tr>
            <tr>
                <td>4. </td> <td></td>
                <td>Klasifikasi Aset</td>
                <td>:</td>
                <td>{{ $agenda->klas_aset }}</td>
            </tr>
            <tr>
                <td>5. </td> <td></td>
                <td>Lokasi Aset</td>
                <td>:</td>
                <td>Dinas Komunikasi dan Informatika</td>
            </tr>
            <tr>
                <td>6. </td> <td></td>
                <td>Nomor & Tgl BA Penerimaan</td>
                <td>:</td>
                <td>{{ $agenda->bast }}, {{ $agenda->tgl_bast_formatted }}</td>
            </tr>
            <tr>
                <td>7. </td> <td></td>
                <td>Nomor & Tgl BA Pemeriksaan</td>
                <td>:</td>
                <td>{{ $agenda->bahp }}, {{ $agenda->tgl_bahp_formatted }}</td>
            </tr>
            <tr>
                <td>8. </td> <td></td>
                <td>Realisasi Pembayaran</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>
        <br>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                <th style="border: 1px solid black; text-align: left; padding: 8px;">No</th>
                <th style="border: 1px solid black; padding: 8px;">Uraian</th>
                <th style="border: 1px solid black; padding: 8px;">Nomor & Tgl SP2D</th>
                <th style="border: 1px solid black; padding: 8px;">Nomor & Tgl SPM</th>
                <th style="border: 1px solid black; padding: 8px;">Nilai Uang</th>
                <th style="border: 1px solid black; padding: 8px;">Kode Rekening</th>
            </tr>
            <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                <td style="border: 1px solid black; text-align: left; padding: 8px;">1</td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;">Biaya Pembelian</td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;">{{ $agenda->sp2d }}, {{ $agenda->tgl_sp2d_formatted }}</td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;">{{ $agenda->spm }}, {{ $agenda->tgl_spm_formatted }}</td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;">Rp {{ number_format($agenda->nilai_kontrak, 2, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;">{{ $rekening }}</td>
            </tr>
            <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;">Sub Jumlah</td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;">Rp {{ number_format($agenda->nilai_kontrak, 2, ',', '.') }}</td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
            </tr>
            <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"><b>Jumlah Total</b></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"><b>Rp {{ number_format($agenda->nilai_kontrak, 2, ',', '.') }}</b></td>
                <td style="border: 1px solid black; text-align: left; padding: 8px;"></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>9. </td> <td></td>
                <td>Rincian Perolehan Aset Tetap</td>
            </tr>
        </table>
        <br>
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <thead>
                <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                    <th rowspan="2" style="border: 1px solid black; padding: 8px;">No.</th>
                    <th rowspan="2" style="border: 1px solid black; padding: 8px;">Nama Barang</th>
                    <th rowspan="2" style="border: 1px solid black; padding: 8px;">Jumlah Barang</th>
                    <th colspan="2" style="border: 1px solid black; padding: 8px;">Biaya</th>
                    <th rowspan="2" style="border: 1px solid black; padding: 8px;">Jumlah Nilai Aset</th>
                </tr>
                <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                    <th style="border: 1px solid black; padding: 8px;">Harga Satuan</th>
                    <th style="border: 1px solid black; padding: 8px;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>
                        Belanja {{ $agenda->klas_aset }}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                    <td style="border: 1px solid black; text-align: left; padding: 8px;">1.</td>
                    <td class="text-left" style="border: 1px solid black; text-align: left; padding: 8px;">
                            @foreach ($agendadtl->groupBy('nama_barang') as $nama_barang => $barangs)
                                -{{ $nama_barang }} <br>
                            @endforeach
                    </td>
                    <td style="border: 1px solid black; padding: 8px;">
                        @foreach ($groupedBarang as $nama_barang => $barang)
                                {{ $barang['jumlah'] }} <br>
                        @endforeach
                    </td>
                    <td style="border: 1px solid black; text-align: left; padding: 8px;">
                        @foreach ($groupedBarang as $nama_barang => $barang)
                            Rp {{ number_format($barang['harga'], 2, ',', '.') }} <br>
                        @endforeach
                    </td>
                    <td style="border: 1px solid black; text-align: left; padding: 8px;">
                        @foreach ($groupedBarang as $nama_barang => $barang)
                            Rp {{ number_format($barang['total_nilai'], 2, ',', '.') }} <br>
                        @endforeach
                    </td>
                    <td style="border: 1px solid black; text-align: left; padding: 8px;">
                        @foreach ($groupedBarang as $nama_barang => $barang)
                            Rp {{ number_format($barang['total_nilai'], 2, ',', '.') }} <br>
                        @endforeach
                    </td>
                </tr>
                <tr style="border: 1px solid black; text-align: left; padding: 8px;">
                    <td colspan="4" class="text-left" style="border: 1px solid black; text-align: left; padding: 8px;">Jumlah</td>
                    <td style="border: 1px solid black; text-align: left; padding: 8px;"> Rp {{ number_format($totalKeseluruhan, 2, ',', '.') }}</td>
                    <td style="border: 1px solid black; text-align: left; padding: 8px;"> Rp {{ number_format($totalKeseluruhan, 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>    
    </div>
    <P>Nota Bukti Memorial ini dibuat dengan kondisi yang sebenarnya</P>
    <br>
    <table class="signature-table signature-left">
        <tr>
            <td style="text-align: center;">Gresik, {{ $tgl_persetujuan }}</td>
        </tr>
        <tr>
            <td style="text-align: center;"><b>Kepala Dinas Komunikasi Dan Informatika</b></td>
        </tr>
        <br><br><br>
        <tr>
            <td style="text-align: center;"><b><u>{{ $nama_kadis }}</u></b></td>
        </tr>
        <tr>
            <td style="text-align: center;">NIP.{{ $nip_kadis }}</td>
        </tr>
    </table>
    <br>
    <table class="signature-table signature-right">
        <tr><td></td></tr>
        <tr>
            <td style="text-align: center;"><b>PPTK Kegiatan</b></td>
        </tr>
        <br><br><br>
        <tr>
            <td style="text-align: center;"><b><u>{{ $nama_pptk }}</u></b></td>
        </tr>
        <tr>
            <td style="text-align: center;">Pembina Tk.I</td>
        </tr>
        <tr>
            <td style="text-align: center;">NIP.{{ $nip_pptk }}</td>
        </tr>
    </table>
</body>
</html>
