<?php

namespace App\Http\Controllers;

use App\Model\DetailRuangan;
use App\Model\Fasilitas;
use App\Model\HakMilik;
use App\Model\KategoriRuangan;
use App\Model\Ruangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{

    private $Model;
    private $ModelDetailRuangan;

    public function __construct()
    {
        $this->Model = new Ruangan();
        $this->ModelDetailRuangan = new DetailRuangan();
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {

        $list = $this->Model->loadDataAll();
        $data = [
            'session' => session('user'),
            'data' => $list,
        ];
        return view('ruangan.ruangan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        $data = [
            'session' => session('user'),
            'kategori' => KategoriRuangan::all(),
            'hakMilik' => HakMilik::all()
        ];
        return view('ruangan.add_ruangan', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $ruangan = new Ruangan();
        $ruangan->ruangan_hak_id = $request->get('hak_id');
        $ruangan->ruangan_kategori_id = $request->get('kategori_id');
        $ruangan->kode_ruangan = $request->get('kode');
        $ruangan->nama_ruangan = $request->get('nama');
        $ruangan->deskripsi_ruangan = $request->get('deskripsi');
        $ruangan->kapasitas = $request->get('kapasitas');
        $ruangan->is_active = 'Y';
        $ruangan->save();

        return redirect(url('ruangan/' . $ruangan->ruangan_id . '/edit'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $ruangan = Ruangan::find($id);
        $data = [
            'session' => session('user'),
            'kategori' => KategoriRuangan::all(),
            'hakMilik' => HakMilik::all(),
            'data' => $ruangan
        ];
        return view('ruangan.edit_ruangan', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->ruangan_hak_id = $request->get('hak_id');
        $ruangan->ruangan_kategori_id = $request->get('kategori_id');
        $ruangan->kode_ruangan = $request->get('kode');
        $ruangan->nama_ruangan = $request->get('nama');
        $ruangan->deskripsi_ruangan = $request->get('deskripsi');
        $ruangan->kapasitas = $request->get('kapasitas');
        $ruangan->update();

        return redirect(url('/ruangan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->delete();
        return redirect(url('/ruangan'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        $ruangan = (array)$this->Model->getDataById($id);
        $fasilitas = Fasilitas::all();
        $detailRu = $this->ModelDetailRuangan->loadDataByIdRuangan($id);
        $data = [
            'session' => session('user'),
            'data' => $ruangan,
            'fasilitas' => $fasilitas,
            'listFasilitas' => $detailRu,
        ];
        return view('ruangan.view_ruangan', $data);
    }

    public function validasi(Request $request)
    {
        $id = $request->id;
        $data = Ruangan::where('kode_ruangan', '=', $request->kode)
            ->whereNull('deleted_at')->get()->toArray();

        if (empty($data)) {
            $valid = response()->json(true);
        } else {
            $valid = response()->json(false);
            if ($data[0]['ruangan_id'] === $id) {
                $valid = response()->json(true);
            }
        }

        return $valid;
    }
}
