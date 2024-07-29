<?php

namespace App\Http\Controllers;

//import Model 

use App\Models\BarangPakaiHabis;
use App\Models\Penyedia;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class BarangPakaiHabisController extends Controller
{
    
     /**
     * index
     *
     * @return View
     */
    public function index(): view
    {
        return view('kantor.barang pakai habis.barang_pakai_habis');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = BarangPakaiHabis::select('*');
            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $editUrl = route('barangs.edit', $row->id);
                    $deleteUrl = route('barangs.destroy', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">EDIT</a>
                            <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda Yakin Untuk Menghapus Barang ?\');">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>';
                })
                ->rawColumns(['action'])
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
            'jenis_barang'=> 'required',
            'stok'        => 'required',
            'harga_satuan'=> 'required'
        ]);

        //create post
        BarangPakaiHabis::create([
            'jenis_barang'=> $request->jenis_barang,
            'stok'        => $request->stok,
            'harga_satuan'=> $request->harga_satuan
        ]);

        //redirect to index
        return redirect()->route('barangs.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $barang = BarangPakaiHabis::findOrFail($id);

        return view('kantor.barang pakai habis.edit_barangpakaihabis', compact('barang'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'jenis_barang'=> 'required',
            'stok'        => 'required',
            'harga_satuan'=> 'required'
        ]);

        $barang = BarangPakaiHabis::findOrFail($id);

        $barang->update([
            'jenis_barang'=> $request->jenis_barang,
            'stok'        => $request->stok,
            'harga_satuan'=> $request->harga_satuan
        ]);

        return redirect()->route('barangs.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $barang = BarangPakaiHabis::findOrFail($id);

        //delete post
        $barang->delete();

        //redirect to index
        return redirect()->route('barangs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
