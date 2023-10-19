<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pegawaispt;
use App\Models\PenandatanganSpt;
use App\Models\Spt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $kirim['pegawais'] = Pegawai::where('status', 1)->orderBy('nama', 'ASC')->get();
        $kirim['penandatangans'] = PenandatanganSpt::where('status', 1)->get();
        $kirim['spts'] = Spt::with('pegawaispt')->get();
        $kirim['tgl_sekarang'] = Carbon::now()->isoFormat('D MMM Y');

        // dd($kirim['spts']->penandatanganspt->pegawai);
        return view('content.spt', $kirim);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate(
            [
                'no_surat' => 'required',
                'judul' => 'required',

            ],
            [
                'no_surat.required' => "No. Surat Harus Di Isi",
                'judul.required' => "Kegiatan Harus Di Isi",
            ]
        );

        $create_spt = [
            'no_surat' => $request->no_surat,
            'judul' => $request->judul,
            'berangkat' => $request->berangkat,
            'tgl' => $request->tgl_spt,
            'penandatanganspt_id' => $request->penandatangan,
        ];
        if ($request->pulang == null) {
            $create_spt['pulang'] = $request->berangkat;
        } else {
            $create_spt['pulang'] = $request->pulang;
        }
        $spt = Spt::create($create_spt);


        $jml_pegawai = count($request->pegawai);
        for ($i = 0; $i < $jml_pegawai; $i++) {
            Pegawaispt::create([
                'pegawai_id' =>  $request->pegawai[$i],
                'spt_id' => $spt->id
            ]);
        }
        return response()->json(['url' => url('spt')]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
