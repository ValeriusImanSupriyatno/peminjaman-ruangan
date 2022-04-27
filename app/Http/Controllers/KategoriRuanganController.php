<?php

namespace App\Http\Controllers;

use App\Model\KategoriRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $list = KategoriRuangan::whereNull('deleted_at')->get();

        $data = [
            'session' => session('user'),
            'data' => $list,
        ];
        return view('kategoriRuangan.kategori', $data);
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
        return view('kategoriRuangan.add_kategori', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $kategori = new KategoriRuangan();
        $kategori->kode_kategori = $request->get('kode');
        $kategori->nama_kategori = $request->get('nama');
        $kategori->save();

        return redirect(url('/kategori-ruangan'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        $kategori = KategoriRuangan::find($id);
        $data = [
            'session' => session('user'),
            'data' => $kategori
        ];
        return view('kategoriRuangan.edit_kategori', $data);
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
        $kategori = KategoriRuangan::find($id);
        $kategori->kode_kategori = $request->get('kode');
        $kategori->nama_kategori = $request->get('nama');
        $kategori->update();

        return redirect(url('/kategori-ruangan'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return mixed
     */
    public function destroy($id)
    {
        $kategori = KategoriRuangan::find($id);
        $kategori->delete();
        return redirect(url('/kategori-ruangan'));
    }
}
