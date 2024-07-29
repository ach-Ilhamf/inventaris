<?php

namespace App\Http\Controllers;

//import Model 

use App\Models\BarangHabisKeluar;
use App\Models\BarangHabisTerima;
use App\Models\BarangPakaiHabis;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class BarangHabisKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $barangList = BarangPakaiHabis::all();
        return view('kantor.barang pakai habis.barang_habis_keluar', compact('barangList'));

    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $keluar = BarangHabisKeluar::with('barangpakaihabis')->select('barang_habis_keluars.*');

            if ($request->has('jenis_barang') && !empty($request->jenis_barang)) {
                $keluar->whereHas('barangpakaihabis', function($q) use ($request) {
                    $q->where('jenis_barang', 'like', "%{$request->jenis_barang}%");
                });
            }

            if ($request->has('harga_satuan') && !empty($request->harga_satuan)) {
                $keluar->where('barang_habis_keluars.harga_satuan', 'like', "%{$request->harga_satuan}%");
            }
            
            return DataTables::of($keluar)
                ->addColumn('action', function ($keluar) {
                    return '<a href="'.route('barangkeluars.edit', $keluar->id).'" class="btn btn-sm btn-primary">EDIT</a>
                            <form style="display:inline;" method="POST" action="'.route('barangkeluars.destroy', $keluar->id).'" onsubmit="return confirm(\'Apakah Anda Yakin Untuk Menghapus Data ?\');">
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
            'id_barang'     => 'required',
            'tgl_keluar'    => 'required',
            'no_keluar'     => 'required',
            'banyak_barang' => 'required',
            'harga_satuan'  => 'required',
            'unit'          => 'required'
        ]);

        $barang = BarangPakaiHabis::findOrFail($request->id_barang);
        $currentStock = $barang->stok; // Asumsikan 'stok' adalah field untuk stok saat ini dalam model BarangPakaiHabis
    
        // Periksa apakah jumlah yang diminta lebih besar dari stok yang tersedia
        if ($request->banyak_barang > $currentStock) {
            return redirect()->back()->withErrors(['banyak_barang' => 'Jumlah barang yang diminta melebihi stok yang tersedia.']);
        }

        //create post
        BarangHabisKeluar::create([
            'id_barang'     => $request->id_barang,
            'tgl_keluar'    => $request->tgl_keluar,
            'no_keluar'     => $request->no_keluar,
            'banyak_barang' => $request->banyak_barang,
            'harga_satuan'  => $request->harga_satuan,
            'unit'          => $request->unit,
            'keterangan'    => $request->keterangan
    
        ]);

        $barang->stok -= $request->banyak_barang;
        $barang->save();

        //redirect to index
        return redirect()->route('barangkeluars.index');
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
        $keluar = BarangHabisKeluar::findOrFail($id);
        $barangList = BarangPakaiHabis::all();
        return view('kantor.barang pakai habis.edit_baranghabiskeluar', compact('keluar', 'barangList'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'id_barang'     => 'required',
            'tgl_keluar'    => 'required',
            'no_keluar'     => 'required',
            'banyak_barang' => 'required',
            'harga_satuan'  => 'required',
            'unit'          => 'required'
        ]);

        $keluar = BarangHabisKeluar::findOrFail($id);
        $barang = BarangPakaiHabis::findOrFail($request->id_barang);
    
        // Hitung stok yang tersedia dengan mempertimbangkan jumlah banyak_barang saat ini
        $currentStock = $barang->stok + $keluar->banyak_barang;
    
        // Periksa apakah jumlah yang diminta lebih besar dari stok yang tersedia
        if ($request->banyak_barang > $currentStock) {
            return redirect()->back()->withErrors(['banyak_barang' => 'Jumlah barang yang diminta melebihi stok yang tersedia.']);
        }

        $keluar->update([
            'id_barang'     => $request->id_barang,
            'tgl_keluar'    => $request->tgl_keluar,
            'no_keluar'     => $request->no_keluar,
            'banyak_barang' => $request->banyak_barang,
            'harga_satuan'  => $request->harga_satuan,
            'unit'          => $request->unit,
            'keterangan'    => $request->keterangan
        ]);

        $barang->stok = $currentStock - $request->banyak_barang;
        $barang->save();

        return redirect()->route('barangkeluars.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $keluar = BarangHabisKeluar::findOrFail($id);

        //delete post
        $keluar->delete();

        //redirect to index
        return redirect()->route('barangkeluars.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
