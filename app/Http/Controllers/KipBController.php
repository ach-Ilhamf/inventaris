<?php

namespace App\Http\Controllers;

//import Model 
use App\Models\KipB;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class KipBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $kipbs = KipB::oldest()->paginate();

        return view('kantor.kip b.kip_b', compact('kipbs'));

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
            'kode_barang'    => 'required',
            'jenis_barang'   => 'required',
            'no_register'    => 'required',
            'tahun_beli'     => 'required',
            'harga'          => 'required',
            'beban_susut'    => 'required',
            'kondisi'        => 'required',
            'lokasi'         => 'required',
        ]);

        //create post
        KipB::create([
            'kode_barang'   => $request->kode_barang,
            'jenis_barang'  => $request->jenis_barang,
            'no_register'   => $request->no_register,
            'merk'          => $request->merk,
            'type'          => $request->type,
            'ukuran'        => $request->ukuran,
            'bahan'         => $request->bahan,
            'tahun_beli'    => $request->tahun_beli,
            'no_pabrik'     => $request->no_pabrik,
            'no_rangka'     => $request->no_rangka,
            'no_mesin'      => $request->no_mesin,
            'no_polisi'     => $request->no_polisi,
            'no_bpkb'       => $request->no_bpkb,
            'asal_usul'     => $request->asal_usul,
            'harga'         => $request->harga,
            'beban_susut'   => $request->beban_susut,
            'nilai_buku'    => $request->nilai_buku,
            'kondisi'       => $request->kondisi,
            'lokasi'        => $request->lokasi
    
        ]);

        //redirect to index
        return redirect()->route('kipbs.index');
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
        $kipb = KipB::findOrFail($id);

        return view('kantor.kip b.edit_kip', compact('kipb'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'kode_barang'    => 'required',
            'jenis_barang'   => 'required',
            'no_register'    => 'required',
            'tahun_beli'     => 'required',
            'harga'          => 'required',
            'beban_susut'    => 'required',
            'kondisi'        => 'required',
            'lokasi'         => 'required',
        ]);

        $kipb = KipB::findOrFail($id);

        $kipb->update([
            'kode_barang'   => $request->kode_barang,
            'jenis_barang'  => $request->jenis_barang,
            'no_register'   => $request->no_register,
            'merk'          => $request->merk,
            'type'          => $request->type,
            'ukuran'        => $request->ukuran,
            'bahan'         => $request->bahan,
            'tahun_beli'    => $request->tahun_beli,
            'no_pabrik'     => $request->no_pabrik,
            'no_rangka'     => $request->no_rangka,
            'no_mesin'      => $request->no_mesin,
            'no_polisi'     => $request->no_polisi,
            'no_bpkb'       => $request->no_bpkb,
            'asal_usul'     => $request->asal_usul,
            'harga'         => $request->harga,
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
        $kipb = KipB::findOrFail($id);

        //delete post
        $kipb->delete();

        //redirect to index
        return redirect()->route('kipbs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
