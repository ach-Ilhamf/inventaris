<?php

namespace App\Http\Controllers;

//import Model 

use App\Models\Penyedia;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

class PenyediaController extends Controller
{
    
     /**
     * index
     *
     * @return View
     */
    public function index(): view
    {
        $penyedias = Penyedia::oldest()->paginate();

        return view('kantor.agenda masuk.penyedia', compact('penyedias'));
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
        //get post by ID
        $penyedia = Penyedia::findOrFail($id);

        //delete post
        $penyedia->delete();

        //redirect to index
        return redirect()->route('penyedias.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
