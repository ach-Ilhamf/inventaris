<?php

namespace App\Http\Controllers;

//import Model 

use App\Models\BarangHabisTerima;
use App\Models\BarangPakaiHabis;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

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

            if ($request->has('harga_satuan') && !empty($request->harga_satuan)) {
                $terima->where('harga_satuan', 'like', "%{$request->harga_satuan}%");
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
            'id_barang'     => 'required',
            'tgl_spk'       => 'required',
            'no_spk'        => 'required',
            'no_dpa'        => 'required',
            'banyak_barang' => 'required',
            'harga_satuan'  => 'required',
            'unit'          => 'required',
        ]);

        //create post
        BarangHabisTerima::create([
            'kode_barang'   => $request->kode_barang,
            'id_barang'     => $request->id_barang,
            'tgl_spk'       => $request->tgl_spk,
            'no_spk'        => $request->no_spk,
            'tgl_dpa'       => $request->tgl_dpa,
            'no_dpa'        => $request->no_dpa,
            'banyak_barang' => $request->banyak_barang,
            'harga_satuan'  => $request->harga_satuan,
            'unit'          => $request->unit,
            'keterangan'    => $request->keterangan
    
        ]);

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
            'kode_barang'   => 'required',
            'id_barang'     => 'required',
            'tgl_spk'      => 'required',
            'no_spk'        => 'required',
            'no_dpa'        => 'required',
            'banyak_barang' => 'required',
            'harga_satuan'  => 'required',
            'unit'          => 'required',
        ]);

        $terima = BarangHabisTerima::findOrFail($id);

        $terima->update([
            'kode_barang'   => $request->kode_barang,
            'id_barang'     => $request->id_barang,
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
