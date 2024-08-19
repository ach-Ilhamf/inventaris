<?php

namespace App\Http\Controllers;

//import Model 

use App\Models\Penyedia;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class PenyediaController extends Controller
{
    
     /**
     * index
     *
     * @return View
     */
    public function index(): view
    {
        return view('kantor.agenda masuk.penyedia');
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Penyedia::select('*');
            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $editUrl = route('penyedias.edit', $row->id);
                    $deleteUrl = route('penyedias.destroy', $row->id);
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
            'nama'      => 'required',
            'alamat'    => 'required',
            'npwp'      => 'required'
        ]);

        //create post
        Penyedia::create([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'npwp'      => $request->npwp
        ]);

        //redirect to index
        return redirect()->route('penyedias.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $penyedia = Penyedia::findOrFail($id);

        return view('kantor.agenda masuk.edit_penyedia', compact('penyedia'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama'      => 'required',
            'alamat'    => 'required',
            'npwp'      => 'required'
        ]);

        $penyedia = Penyedia::findOrFail($id);

        $penyedia->update([
            'nama'      => $request->nama,
            'alamat'    => $request->alamat,
            'npwp'       => $request->npwp,
        ]);

        return redirect()->route('penyedias.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $post
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        $penyedia = Penyedia::findOrFail($id);

        $relatedTabel = $penyedia->agendamasuk()->exists();

        if ($relatedTabel) {
            return redirect()->route('penyedias.index')->withErrors('Data tidak bisa dihapus karena terkait dengan data kegiatan masuk');
        }    

        $penyedia->delete();

        return redirect()->route('penyedias.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
