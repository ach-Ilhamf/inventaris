<?php

namespace App\Http\Controllers;

use App\Models\AgendaMasuk;
use App\Models\AgendaMasukDetail;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AgendaMasukDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_agenda): view
    {
        $agenda = AgendaMasuk::findOrFail($id_agenda);
        $agendadtls = AgendaMasukDetail::where('id_agenda', $id_agenda)->paginate();
    
        return view('kantor.agenda masuk.agenda_masuk_detail', compact('agenda', 'agendadtls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_agenda): view
    {
        return view('kantor.agenda masuk.tambah_agenda_detail', compact('id_agenda'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'id_agenda'     => 'required',
            'nama_barang'   => 'required',
            'gambar'        => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'satuan'        => 'required',
            'harga_satuan'  => 'required',
        ]);

        $request->hasFile('gambar');
        $gambar = $request->file('gambar');
        $gambarName = $gambar->hashName();
        $gambar->storeAs('public/gambar', $gambarName);
        

            //create post
        AgendaMasukDetail::create([
            'id_agenda'     => $request->id_agenda,
            'nama_barang'   => $request->nama_barang,
            'gambar'        => $gambarName,
            'merk'          => $request->merk,
            'tipe'          => $request->tipe,
            'no_rangka'     => $request->no_rangka,
            'no_mesin'      => $request->no_mesin,
            'no_polisi'     => $request->no_polisi,
            'no_bpkb'       => $request->no_bpkb,
            'satuan'        => $request->satuan,
            'harga_satuan'  => $request->harga_satuan,
            'lokasi'        => $request->lokasi
        ]);

        //redirect to index
        return redirect()->route('agendadtls.index', ['id_agenda' => $request->id_agenda])
                        ->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $agenda = AgendaMasuk::findOrFail($id);
        $agendadtls = AgendaMasukDetail::where('id_agenda', $id)->get();
    
        return view('.kantor.agenda masuk.agenda_masuk_detail', compact('agenda', 'agendadtls'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agendadtl = AgendaMasukDetail::findOrFail($id);

        return view('kantor.agenda masuk.edit_agenda_dtl', compact('agendadtl'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

    // Validasi form
    $this->validate($request, [
        'nama_barang'   => 'required',
        'gambar'        => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'satuan'        => 'required',
        'harga_satuan'  => 'required',
    ]);

    // Temukan model berdasarkan ID
    $agendadtl = AgendaMasukDetail::findOrFail($id);

    // Data yang akan diupdate
    $updateData = [
        'nama_barang'   => $request->nama_barang,
        'merk'          => $request->merk,
        'tipe'          => $request->tipe,
        'no_rangka'     => $request->no_rangka,
        'no_mesin'      => $request->no_mesin,
        'no_polisi'     => $request->no_polisi,
        'no_bpkb'       => $request->no_bpkb,
        'satuan'        => $request->satuan,
        'harga_satuan'  => $request->harga_satuan,
        'lokasi'  => $request->lokasi,
    ];

    // Jika ada gambar baru yang diunggah
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $gambarName = $gambar->hashName();
        $gambar->storeAs('public/gambar', $gambarName);

        // Hapus gambar lama dari storage jika ada
        if ($agendadtl->gambar) {
            Storage::delete('public/gambar/' . $agendadtl->gambar);
        }

        // Update nama gambar pada data
        $updateData['gambar'] = $gambarName;
    }

    // Update data pada model
    $agendadtl->update($updateData);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('agendadtls.index', ['id_agenda' => $request->id_agenda])
                ->with(['success' => 'Data Berhasil Diperbarui!']);
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
        $agendadtl = AgendaMasukDetail::findOrFail($id);

        //delete post
        $agendadtl->delete();

        //redirect to index
        return redirect()->route('agendadtls.index', ['id_agenda' => $agendadtl->id_agenda])
        ->with(['success' => 'Data Berhasil Dihapus!']);    }
}
