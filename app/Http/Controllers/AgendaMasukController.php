<?php

namespace App\Http\Controllers;

//import Model 
use App\Models\AgendaMasuk;
use App\Models\AgendaMasukDetail;
use App\Models\Penyedia;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

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
        $penyediaList = Penyedia::all();

        return view('kantor.agenda masuk.agenda_masuk', compact('penyediaList'));
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = AgendaMasuk::with('penyedia')->select('agenda_masuks.*');

            if ($request->has('nama_agenda') && !empty($request->nama_agenda)) {
                $data->where('nama_agenda', 'like', "%{$request->nama_agenda}%");
            }

            if ($request->has('penyedia') && !empty($request->penyedia)) {
                $data->whereHas('penyedia', function($q) use ($request) {
                    $q->where('nama', 'like', "%{$request->penyedia}%");
                });
            }

            if ($request->has('nilai_kontrak') && !empty($request->nilai_kontrak)) {
                $data->where('nilai_kontrak', 'like', "%{$request->nilai_kontrak}%");
            }

            return DataTables::of($data)
                ->addColumn('action', function($row) {
                    $showUrl = route('agendadtls.index', ['id_agenda' => $row->id]);
                    $editUrl = route('agendas.edit', $row->id);
                    $deleteUrl = route('agendas.destroy', $row->id);
                    return '<a href="' . $showUrl . '" class="btn btn-sm btn-dark">DATA BARANG</a>
                            <a href="' . $editUrl . '" class="btn btn-sm btn-primary">EDIT</a>
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
        ]);

        //create post
        $agenda = AgendaMasuk::create([
            'id_penyedia'   => $request->id_penyedia,
            'nama_agenda'   => $request->nama_agenda,
            'nilai_kontrak' => $request->nilai_kontrak,
            'klas_aset'     => $request->klas_aset,
            'tgl_masuk'     => $request->tgl_masuk,
            'skp'           => $request->skp,
            'spm'           => $request->spm,
            'tgl_spm'       => $request->tgl_spm,
            'sp2d'          => $request->sp2d,
            'tgl_sp2d'       => $request->tgl_sp2d,
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
        ]);

        $agenda = AgendaMasuk::findOrFail($id);

        $agenda->update([
            'id_penyedia'   => $request->id_penyedia,
            'nama_agenda'   => $request->nama_agenda,
            'nilai_kontrak' => $request->nilai_kontrak,
            'klas_aset'     => $request->klas_aset,
            'tgl_masuk'     => $request->tgl_masuk,
            'skp'           => $request->skp,
            'spm'           => $request->spm,
            'tgl_spm'       => $request->tgl_spm,
            'sp2d'          => $request->sp2d,
            'tgl_sp2d'      => $request->tgl_sp2d,
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