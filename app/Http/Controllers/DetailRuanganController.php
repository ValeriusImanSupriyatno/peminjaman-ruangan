<?php

namespace App\Http\Controllers;

use App\Model\DetailRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailRuanganController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $jumlah = 1;
        if (empty($request->get('jumlah')) === false) {
            $jumlah = $request->get('jumlah');
        }
        $detRu = new DetailRuangan();
        $detRu->detru_ruangan_id = $request->get('idRuangan');
        $detRu->detru_fasilitas_id = $request->get('fasilitas');
        $detRu->detru_jumlah = $jumlah;
        $detRu->save();

        return redirect(url('/ruangan/' . $request->get('idRuangan') . '/detail'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function update(Request $request)
    {
        $jumlah = 1;
        if (empty($request->get('edit_jumlah')) === false) {
            $jumlah = $request->get('edit_jumlah');
        }
        $detRu = DetailRuangan::find($request->get('id_detru'));
        $detRu->detru_fasilitas_id = $request->get('edit_id_fasilitas');
        $detRu->detru_jumlah = $jumlah;
        $detRu->update();

        return redirect(url('ruangan/' . $request->get('edit_id_ruangan') . '/detail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $fasilitas = DetailRuangan::find($id);
        $fasilitas->delete();

        return redirect(url('ruangan/' . $fasilitas->detru_ruangan_id . '/detail'));
    }
}
