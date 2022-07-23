<?php

namespace App\Http\Controllers;

use App\Model\HakMilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HakMilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $list = HakMilik::whereNull('deleted_at')->get();

        $data = [
            'session' => session('user'),
            'data' => $list,
        ];
        return view('hakMilik.hak_milik', $data);
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
        return view('hakMilik.add_hak_milik', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $hakMilik = new HakMilik();
        $hakMilik->kode_hak = $request->get('kode');
        $hakMilik->nama_hak = $request->get('nama');
        $hakMilik->save();

        return redirect(url('/hak-milik'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $hakMilik = HakMilik::find($id);
        $data = [
            'session' => session('user'),
            'data' => $hakMilik
        ];
        return view('hakMilik.edit_hak_milik', $data);
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
        $hakMilik = HakMilik::find($id);
        $hakMilik->kode_hak = $request->get('kode');
        $hakMilik->nama_hak = $request->get('nama');
        $hakMilik->update();

        return redirect(url('/hak-milik'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $hakMilik = HakMilik::find($id);
        $hakMilik->delete();
        return redirect(url('/hak-milik'));
    }


    public function validasi(Request $request)
    {
        $id = $request->id;
        $data = HakMilik::where('kode_hak', '=', $request->kode)
            ->whereNull('deleted_at')->get()->toArray();
        if (empty($data)) {
            $valid = response()->json(true);
        } else {
            $valid = response()->json(false);
            if ($data[0]['hak_id'] === $id) {
                $valid = response()->json(true);
            }
        }

        return $valid;
    }
}
