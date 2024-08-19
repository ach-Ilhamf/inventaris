<?php

namespace App\Http\Controllers;

//import Model 

use App\Models\Pegawai;
use App\Models\Penyedia;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class PegawaiController extends Controller
{
    
     /**
     * index
     *
     * @return View
     */
    public function index(): view
    {
        return view('kantor.kip b.pegawai');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Pegawai::select('*');
            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $editUrl = route('pegawais.edit', $row->id);
                    $deleteUrl = route('pegawais.destroy', $row->id);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">EDIT</a>
                            <form action="' . $deleteUrl . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda Yakin Untuk Menghapus Pegawai ?\');">
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
            'nama_pegawai'  => 'required',
            'nip'           => 'required',
            'unit'          => 'required'
        ]);

        //create post
        Pegawai::create([
            'nama_pegawai'  => $request->nama_pegawai,
            'nip'           => $request->nip,
            'unit'          => $request->unit
        ]);

        //redirect to index
        return redirect()->route('pegawais.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $pegawai = Pegawai::findOrFail($id);

        return view('kantor.kip b.edit_pegawai', compact('pegawai'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama_pegawai'  => 'required',
            'nip'           => 'required',
            'unit'          => 'required'
        ]);

        $penyedia = Pegawai::findOrFail($id);

        $penyedia->update([
            'nama_pegawai'  => $request->nama_pegawai,
            'nip'           => $request->nip,
            'unit'          => $request->unit
        ]);

        return redirect()->route('pegawais.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $pegawai = Pegawai::findOrFail($id);

        $relatedTabel = $pegawai->agendamasukdetail()->exists();

        if ($relatedTabel) {
            return redirect()->route('pegawais.index')->withErrors('Data tidak bisa dihapus karena terkait dengan barang KIP-B');
        }

        $pegawai->delete();

        return redirect()->route('pegawais.index')->with(['success' => 'Data Berhasil Dihapus!']);
}
}
