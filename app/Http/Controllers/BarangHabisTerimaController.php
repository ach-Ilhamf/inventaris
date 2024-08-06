<?php

namespace App\Http\Controllers;

//import Model 

use App\Exports\ExportBarangTerima;
use App\Models\BarangHabisTerima;
use App\Models\BarangPakaiHabis;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class BarangHabisTerimaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $barangList = BarangPakaiHabis::all();
        return view('kantor.barang pakai habis.barang_habis_terima', compact('barangList'));

    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $terima = BarangHabisTerima::with('barangpakaihabis')->select('barang_habis_terimas.*');

            if ($request->has('jenis_barang') && !empty($request->jenis_barang)) {
                $terima->whereHas('barangpakaihabis', function($q) use ($request) {
                    $q->where('jenis_barang', 'like', "%{$request->jenis_barang}%");
                });
            }

            if ($request->has('tgl_terima') && !empty($request->tgl_terima)) {
                $terima->where('tgl_terima', 'like', "%{$request->tgl_terima}%");
            }

            return DataTables::of($terima)
                ->addColumn('action', function ($terima) {
                    return '<a href="'.route('barangterimas.edit', $terima->id).'" class="btn btn-sm btn-primary">EDIT</a>
                            <form style="display:inline;" method="POST" action="'.route('barangterimas.destroy', $terima->id).'" onsubmit="return confirm(\'Apakah Anda Yakin Untuk Menghapus Data ?\');">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>';
                })
                ->make(true);
        }
    }

    public function export_barang_terima(Request $request)
    {
        $excludeColumns = ['id', 'id_barang','tgl_spk', 'no_spk', 'tgl_dpa', 'no_dpa',
                                'keterangan', 'created_at', 'updated_at']; 

        $filters = [
            'jenis_barang'   => $request->input('jenis_barang'),
            'tgl_terima'     => $request->input('tgl_terima')
        ];

        $columnMappings = [
            'kode_barang'   => 'Kode Barang',
            'jenis_barang'  => 'Nama Barang',
            'tgl_terima'    => 'Tanggal Masuk',
            'banyak_barang' => 'Jumlah Barang',
            'harga_satuan'  => 'Nilai Barang',
            'unit'          => 'Keterangan'
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

        return Excel::download(new ExportBarangTerima($excludeColumns, $filters, $columnMappings, $approvalDetails), 'penerimaan barang pakai habis.xlsx');
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
            'id_barang'     => 'required',
            'tgl_terima'    => 'required',
            'banyak_barang' => 'required',
            'harga_satuan'  => 'required',
            'unit'          => 'required',
        ]);

        for ($i = 0; $i < $request->banyak_barang; $i++) {
        BarangHabisTerima::create([
            'kode_barang'   => $request->kode_barang,
            'id_barang'     => $request->id_barang,
            'tgl_terima'    => $request->tgl_terima, 
            'tgl_spk'       => $request->tgl_spk,
            'no_spk'        => $request->no_spk,
            'tgl_dpa'       => $request->tgl_dpa,
            'no_dpa'        => $request->no_dpa,
            'banyak_barang' => 1,
            'harga_satuan'  => $request->harga_satuan,
            'unit'          => $request->unit,
            'keterangan'    => $request->keterangan
    
        ]);
        }
        //redirect to index
        return redirect()->route('barangterimas.index');
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
        $terima = BarangHabisTerima::findOrFail($id);
        $barangList = BarangPakaiHabis::all();
        return view('kantor.barang pakai habis.edit_baranghabisterima', compact('terima', 'barangList'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'id_barang'     => 'required',
            'tgl_terima'    => 'required',
            'banyak_barang' => 'required',
            'harga_satuan'  => 'required',
            'unit'          => 'required',
        ]);

        $terima = BarangHabisTerima::findOrFail($id);

        $terima->update([
            'kode_barang'   => $request->kode_barang,
            'id_barang'     => $request->id_barang,
            'tgl_terima'    => $request->tgl_terima, 
            'tgl_spk'       => $request->tgl_spk,
            'no_spk'        => $request->no_spk,
            'tgl_dpa'       => $request->tgl_dpa,
            'no_dpa'        => $request->no_dpa,
            'banyak_barang' => $request->banyak_barang,
            'harga_satuan'  => $request->harga_satuan,
            'unit'          => $request->unit,
            'keterangan'    => $request->keterangan
        ]);

        return redirect()->route('barangterimas.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $terima = BarangHabisTerima::findOrFail($id);

        //delete post
        $terima->delete();

        //redirect to index
        return redirect()->route('barangterimas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
