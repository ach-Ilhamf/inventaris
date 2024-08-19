<?php

namespace App\Http\Controllers;

//return type View

use App\Models\KodeBarang;
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\Storage;

class KodeBarangController extends Controller
{
     /**
     * index
     *
     * @return View
     */
    public function index(): view
    {
        return view('kantor.kip b.kode_barang');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = KodeBarang::select('*');
            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $editUrl = route('kodes.edit', $row->id);
                    $deleteUrl = route('kodes.destroy', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">EDIT</a>
                            <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda Yakin Untuk Menghapus Data ?\');">
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
            'kode_barang'     => 'required',
            'jenis_barang'    => 'required'
        ]);

        //create post
        KodeBarang::create([
            'kode_barang'     => $request->kode_barang,
            'jenis_barang'    => $request->jenis_barang,
        ]);

        //redirect to index
        return redirect()->route('kodes.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $kode = KodeBarang::findOrFail($id);

        return view('kantor.kip b.edit_kodebarang', compact('kode'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'kode_barang'     => 'required',
            'jenis_barang'    => 'required'
        ]);

        $kode = KodeBarang::findOrFail($id);

        $kode->update([
            'kode_barang'     => $request->kode_barang,
            'jenis_barang'          => $request->jenis_barang
        ]);

        return redirect()->route('kodes.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $kode = KodeBarang::findOrFail($id);

        $relatedTabel = $kode->agendadetail()->exists();

        if ($relatedTabel) {
            return redirect()->route('kodes.index')->withErrors('Data tidak bisa dihapus karena terkait dengan barang KIP-B');
        }    

        //delete post
        $kode->delete();

        //redirect to index
        return redirect()->route('kodes.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
