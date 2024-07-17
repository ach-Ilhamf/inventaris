<?php

namespace App\Http\Controllers;

//import Model 
use App\Models\AgendaMasuk;
use App\Models\Penyedia;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class AgendaMasukController extends Controller
{

     /**
     * index
     *
     * @return View
     */
    public function index(): view
    {
        $agendas = AgendaMasuk::oldest()->paginate();
        $penyediaList = Penyedia::all();

        return view('kantor.agenda masuk.agenda_masuk', compact('agendas', 'penyediaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


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
            'id_penyedia'   => 'required',
            'nama_agenda'   => 'required',
            'nilai_kontrak' => 'required',
            'klas_aset'     => 'required',
            'tgl_masuk'     => 'required',
            'skp'           => 'required',
            'bahp'          => 'required',
            'tgl_bahp'      => 'required',
            'bast'          => 'required',
            'tgl_bast'      => 'required'
        ]);

        //create post
        $agenda = AgendaMasuk::create([
            'id_penyedia'   => $request->id_penyedia,
            'nama_agenda'   => $request->nama_agenda,
            'nilai_kontrak' => $request->nilai_kontrak,
            'klas_aset'     => $request->klas_aset,
            'tgl_masuk'     => $request->tgl_masuk,
            'skp'           => $request->skp,
            'bahp'          => $request->bahp,
            'tgl_bahp'      => $request->tgl_bahp,
            'bast'          => $request->bast,
            'tgl_bast'      => $request->tgl_bast,
            'dokumen'       => $request->dokumen,
            'Keterangan'    => $request->Keterangan
        ]);

        //redirect to index
        return redirect()->route('agendadtls.create', ['id_agenda' => $agenda->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $agenda = AgendaMasuk::findOrFail($id);
        $penyediaList = Penyedia::all();

        return view('kantor.agenda masuk.edit_agenda', compact('agenda', 'penyediaList'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'id_penyedia'   => 'required',
            'nama_agenda'   => 'required',
            'nilai_kontrak' => 'required',
            'klas_aset'     => 'required',
            'tgl_masuk'     => 'required',
            'skp'           => 'required',
            'bahp'          => 'required',
            'tgl_bahp'      => 'required',
            'bast'          => 'required',
            'tgl_bast'      => 'required'
        ]);

        $agenda = AgendaMasuk::findOrFail($id);

        $agenda->update([
            'id_penyedia'   => $request->id_penyedia,
            'nama_agenda'   => $request->nama_agenda,
            'nilai_kontrak' => $request->nilai_kontrak,
            'klas_aset'     => $request->klas_aset,
            'tgl_masuk'     => $request->tgl_masuk,
            'skp'           => $request->skp,
            'bahp'          => $request->bahp,
            'tgl_bahp'      => $request->tgl_bahp,
            'bast'          => $request->bast,
            'tgl_bast'      => $request->tgl_bast,
            'dokumen'       => $request->dokumen,
            'Keterangan'    => $request->Keterangan
        ]);

        return redirect()->route('agendas.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $agenda = AgendaMasuk::findOrFail($id);

        //delete post
        $agenda->delete();

        //redirect to index
        return redirect()->route('agendas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}