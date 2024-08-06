<?php

namespace App\Http\Controllers;

use App\Models\AgendaMasuk;
use App\Models\AgendaMasukDetail;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Storage;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaMasukDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_agenda): view
    {
        return view('kantor.agenda masuk.agenda_masuk_detail');
    }

    public function getData($id_agenda)
    {
        $agendadtls = AgendaMasukDetail::with('pegawai')->where('id_agenda', $id_agenda)
            ->get();

        return DataTables::of($agendadtls)
            ->addColumn('nama_agenda', function ($detail) {
                return $detail->agendamasuk ? $detail->agendamasuk->nama_agenda : '';
            })
            ->addColumn('gambar', function ($detail) {
                return '<img src="' . asset('storage/gambar/' . $detail->gambar) . '" class="rounded" style="width: 150px">';
            })
            ->addColumn('action', function ($detail) {
                return ' <a href="' . route('agendadtls.edit', $detail->id) . '" class="btn btn-sm btn-primary">EDIT</a>
                            <form action="' . route('agendadtls.destroy', $detail->id) . '" method="POST" style="display:inline-block;" onsubmit="return confirm(\'Apakah Anda Yakin Untuk Menghapus Data ?\');">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                            </form>';
                
            })
            ->rawColumns(['gambar', 'action']) // Render kolom gambar dan action dengan HTML
            ->make(true);
    }

    public function buktiMemorial(Request $request ,$id_agenda)
    {
        $validatedData = $request->validate([
            'tgl_persetujuan'   => 'required',
            'rekening'          => 'string',
            'nama_kadis'        => 'required',
            'nip_kadis'         => 'required',
            'nama_pptk'         => 'required',
            'nip_pptk'          => 'required',
        ]);
    
        $agendadtl = AgendaMasukDetail::with('pegawai')->where('id_agenda', $id_agenda)->get();
        $agenda = AgendaMasuk::with('penyedia')->where('id', $id_agenda)->first();

        Carbon::setLocale('id');
        $agenda->tgl_masuk_formatted = Carbon::parse($agenda->tgl_masuk)->translatedFormat('d F Y');
        $agenda->tgl_bast_formatted = Carbon::parse($agenda->tgl_bast)->translatedFormat('d F Y');
        $agenda->tgl_bahp_formatted = Carbon::parse($agenda->tgl_bahp)->translatedFormat('d F Y');
        $agenda->tgl_spm_formatted = Carbon::parse($agenda->tgl_spm)->translatedFormat('d F Y');
        $agenda->tgl_sp2d_formatted = Carbon::parse($agenda->tgl_sp2d)->translatedFormat('d F Y');
        $validatedData['tgl_persetujuan'] = Carbon::parse($validatedData['tgl_persetujuan'])->format('d F Y');
        
        $groupedBarang = $agendadtl->groupBy('nama_barang')->map(function ($row) {
            $jumlah = $row->sum('satuan');
            $harga = $row->first()->harga_satuan;    
            return [
                'jumlah' => $jumlah,
                'harga' => $harga,
                'total_nilai' => $jumlah * $harga,
                'items' => $row
            ];
        });

        $totalKeseluruhan = $groupedBarang->sum(function($barang) {
            return $barang['total_nilai'];
        });

        $data = array_merge($validatedData, [
            'agenda' => $agenda,
            'agendadtl' => $agendadtl,
            'groupedBarang' => $groupedBarang,
            'totalKeseluruhan' => $totalKeseluruhan
        ]);

        $pdf = Pdf::loadView('kantor.agenda masuk.cetak_buktimemorial', $data)
                    ->setOptions(['defaultFont'=>'Arial']);
        
        return $pdf->download('bukti_memorial.pdf');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_agenda): view
    {
        $pegawaiList = Pegawai::all();
        return view('kantor.agenda masuk.tambah_agenda_detail', compact('id_agenda', 'pegawaiList'));
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
            'id_pegawai'    => 'required',
            'gambar'        => 'image|mimes:jpeg,jpg,png|max:2048',
            'tahun_beli'    => 'required',
            'satuan'        => 'required',
            'harga_satuan'  => 'required',
            'lokasi'        => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');

            for ($i = 0; $i < $request->satuan; $i++) {
                $gambarName = time() . '_' . $i . '.' . $gambar->getClientOriginalExtension();                
                $gambar->storeAs('public/gambar', $gambarName);
                    
                AgendaMasukDetail::create([
                    'id_agenda'     => $request->id_agenda,
                    'nama_barang'   => $request->nama_barang,
                    'id_pegawai'    => $request->id_pegawai,
                    'gambar'        => $gambarName,
                    'merk'          => $request->merk,
                    'tipe'          => $request->tipe,
                    'tahun_beli'    => $request->tahun_beli,
                    'no_rangka'     => $request->no_rangka,
                    'no_mesin'      => $request->no_mesin,
                    'no_polisi'     => $request->no_polisi,
                    'no_bpkb'       => $request->no_bpkb,
                    'satuan'        => 1,
                    'harga_satuan'  => $request->harga_satuan,
                    'lokasi'        => $request->lokasi
                ]);
            }
        }    
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
        $pegawaiList = Pegawai::all();

        return view('kantor.agenda masuk.edit_agenda_dtl', compact('agendadtl', 'pegawaiList'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

    // Validasi form
    $this->validate($request, [
        'nama_barang'   => 'required',
        'id_pegawai'    => 'required',
        'gambar'        => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'tahun_beli'    => 'required',
        'satuan'        => 'required',
        'harga_satuan'  => 'required',
        'lokasi'        => 'required'
    ]);

    // Temukan model berdasarkan ID
    $agendadtl = AgendaMasukDetail::findOrFail($id);

    // Data yang akan diupdate
    $updateData = [
        'nama_barang'   => $request->nama_barang,
        'id_pegawai'    => $request->id_pegawai,
        'merk'          => $request->merk,
        'tipe'          => $request->tipe,
        'tahun_beli'    => $request->tahun_beli,
        'no_rangka'     => $request->no_rangka,
        'no_mesin'      => $request->no_mesin,
        'no_polisi'     => $request->no_polisi,
        'no_bpkb'       => $request->no_bpkb,
        'satuan'        => $request->satuan,
        'harga_satuan'  => $request->harga_satuan,
        'lokasi'        => $request->lokasi,
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

        //delete image
        Storage::delete('public/gambar/'. $agendadtl->gambar);

        //delete post
        $agendadtl->delete();

        //redirect to index
        return redirect()->route('agendadtls.index', ['id_agenda' => $agendadtl->id_agenda])
        ->with(['success' => 'Data Berhasil Dihapus!']);    
    }

}
