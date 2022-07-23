<?php

namespace App\Http\Controllers;

use App\Model\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $list = Fasilitas::whereNull('deleted_at')->get();
        $data = [
            'session' => session('user'),
            'data' => $list,
        ];
        return view('fasilitas.fasilitas', $data);
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
        ];
        return view('fasilitas.add_fasilitas', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $fasilitas = new Fasilitas();
        $fasilitas->kode_fasilitas = $request->get('kode');
        $fasilitas->nama_fasilitas = $request->get('nama');
        $fasilitas->save();

        return redirect(url('/fasilitas'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $fasilitas = Fasilitas::find($id);
        $data = [
            'session' => session('user'),
            'data' => $fasilitas
        ];
        return view('fasilitas.edit_fasilitas', $data);
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
        $fasilitas = Fasilitas::find($id);
        $fasilitas->kode_fasilitas = $request->get('kode');
        $fasilitas->nama_fasilitas = $request->get('nama');
        $fasilitas->update();

        return redirect(url('/fasilitas'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $fasilitas = Fasilitas::find($id);
        $fasilitas->delete();
        return redirect(url('/fasilitas'));
    }

    public function validasi(Request $request)
    {
        $id = $request->id;
        $data = Fasilitas::where('kode_fasilitas', '=', $request->kode)
            ->whereNull('deleted_at')->get()->toArray();
        if (empty($data)) {
            $valid = response()->json(true);
        } else {
            $valid = response()->json(false);
            if ($data[0]['fasilitas_id'] === $id) {
                $valid = response()->json(true);
            }
        }

        return $valid;
    }
}
