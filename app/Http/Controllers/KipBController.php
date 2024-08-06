<?php

namespace App\Http\Controllers;

//import Model 

use App\Models\AgendaMasukDetail;
use App\Models\KodeBarang;
use App\Models\Pegawai;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

use App\Exports\ExportFile;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class KipBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $kodes = KodeBarang::all();
        $pegawaiList = Pegawai::all();
        return view('kantor.kip b.kip_b', compact('kodes','pegawaiList'));

    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
        $kipbs = AgendaMasukDetail::with('pegawai')->select('agenda_masuk_details.*');

        if ($request->has('nama_barang') && !empty($request->nama_barang)) {
            $kipbs->where('nama_barang', 'like', "%{$request->nama_barang}%");
        }

        if ($request->has('tahun_beli') && !empty($request->tahun_beli)) {
            $kipbs->where('tahun_beli', 'like', "%{$request->tahun_beli}%");
        }

        if ($request->has('kondisi') && !empty($request->kondisi)) {
            $kipbs->where('kondisi', 'like', "{$request->kondisi}%");
        }

        return DataTables::of($kipbs)
            ->addColumn('action', function ($kipb) {
                return '<a href="'.route('kipbs.edit', $kipb->id).'" class="btn btn-sm btn-primary">EDIT</a>
                        <form style="display:inline;" method="POST" action="'.route('kipbs.destroy', $kipb->id).'" onsubmit="return confirm(\'Apakah Anda Yakin Untuk Menghapus Data ?\');">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                        </form>';
            })
            ->make(true);
        }
    }

    public function export_kipb_excel(Request $request)
    {
        $excludeColumns = ['id', 'id_agenda', 'gambar', 'ukuran', 'bahan', 'no_pabrik',
                                'no_rangka', 'no_mesin', 'no_polisi', 'no_bpkb', 'asal_usul',
                                'beban_susut', 'nila_buku','created_at', 'updated_at']; 

        $filters = [
            'nama_barang'   => $request->input('nama_barang'),
            'tahun_beli'    => $request->input('tahun_beli'),
            'kondisi'       => $request->input('kondisi'),
        ];

        $columnMappings = [
            'kode_barang'   => 'Kode Barang',
            'nama_barang'   => 'Nama Barang',
            'no_Registe'    => 'Nomor Register',
            'nama_barang'   => 'Nama Barang',
            'merk'          => 'Merk',
            'type'          => 'Type',
            'tahun_beli'    => 'Tahun Beli',
            'satuan'        => 'Jumlah Barang',
            'harga_satuan'  => 'Nilai Barang',
            'kondisi'       => 'Kondisi',
            'lokasi'        => 'Keterangan',
        ];

        Carbon::setLocale('id');
        $approvalDate = Carbon::parse($request->input('approval_date'))->translatedFormat('d F Y');

        $approvalDetails = [
            'date'  => $approvalDate,
            'left'  => [
                'name'      => $request->input('left_name'),
                'position'  => $request->input('left_position'),
                'nip'       => $request->input('left_nip')
            ],
            'right' => [
                'name'      => $request->input('right_name'),
                'position'  => $request->input('right_position'),
                'nip'       => $request->input('right_nip')
            ]
        ];

        return Excel::download(new ExportFile($excludeColumns, $filters, $columnMappings, $approvalDetails), 'kipb.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'kode_barang'   => 'required',
            'nama_barang'   => 'required',
            'no_register'   => 'required',
            'id_pegawai'    => 'required',
            'tahun_beli'    => 'required',
            'satuan'        => 'required',
            'harga_satuan'  => 'required',
            'kondisi'       => 'required',
            'lokasi'        => 'required',
        ]);

        //create post
        AgendaMasukDetail::create([
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'no_register'   => $request->no_register,
            'id_pegawai'    => $request->id_pegawai,
            'merk'          => $request->merk,
            'tipe'          => $request->tipe,
            'ukuran'        => $request->ukuran,
            'bahan'         => $request->bahan,
            'tahun_beli'    => $request->tahun_beli,
            'no_pabrik'     => $request->no_pabrik,
            'no_rangka'     => $request->no_rangka,
            'no_mesin'      => $request->no_mesin,
            'no_polisi'     => $request->no_polisi,
            'no_bpkb'       => $request->no_bpkb,
            'asal_usul'     => $request->asal_usul,
            'harga_satuan'  => $request->harga_satuan,
            'beban_susut'   => $request->beban_susut,
            'nilai_buku'    => $request->nilai_buku,
            'kondisi'       => $request->kondisi,
            'lokasi'        => $request->lokasi
    
        ]);

        //redirect to index
        return redirect()->route('kipbs.index')->with(['success' => 'Data Berhasil Disimpan!']);;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $kipb = AgendaMasukDetail::findOrFail($id);
        $kodes = KodeBarang::all();
        $pegawaiList = Pegawai::all();

        return view('kantor.kip b.edit_kip', compact('kipb', 'kodes', 'pegawaiList'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'kode_barang'   => 'required',
            'nama_barang'   => 'required',
            'no_register'   => 'required',
            'id_pegawai'    => 'required',
            'tahun_beli'    => 'required',
            'satuan'        => 'required',
            'harga_satuan'  => 'required',
            'kondisi'       => 'required',
            'lokasi'        => 'required',
        ]);

        $kipb = AgendaMasukDetail::findOrFail($id);

        $kipb->update([
            'kode_barang'   => $request->kode_barang,
            'nama_barang'   => $request->nama_barang,
            'no_register'   => $request->no_register,
            'id_pegawai'    => $request->id_pegawai,
            'merk'          => $request->merk,
            'tipe'          => $request->tipe,
            'ukuran'        => $request->ukuran,
            'bahan'         => $request->bahan,
            'tahun_beli'    => $request->tahun_beli,
            'no_pabrik'     => $request->no_pabrik,
            'no_rangka'     => $request->no_rangka,
            'no_mesin'      => $request->no_mesin,
            'no_polisi'     => $request->no_polisi,
            'no_bpkb'       => $request->no_bpkb,
            'asal_usul'     => $request->asal_usul,
            'harga_satuan'  => $request->harga_satuan,
            'beban_susut'   => $request->beban_susut,
            'nilai_buku'    => $request->nilai_buku,
            'kondisi'       => $request->kondisi,
            'lokasi'        => $request->lokasi
        ]);

        return redirect()->route('kipbs.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $kipb = AgendaMasukDetail::findOrFail($id);

        //delete post
        $kipb->delete();

        //redirect to index
        return redirect()->route('kipbs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
