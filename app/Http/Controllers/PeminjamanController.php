<?php


namespace App\Http\Controllers;


use App\Model\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    private $Model;

    public function __construct()
    {
        $this->Model = new Peminjaman();
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $list = $this->Model->getAll();
        $data = [
            'session' => session('user'),
            'peminjaman' => $list,
        ];
        return view('transaksi.peminjaman_list', $data);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return mixed
     */
    public function show($id)
    {
        $data = [
            'session' => session('user'),
            'data' => (array)$this->Model->getById($id),
        ];
        return view('transaksi.view_peminjaman', $data);
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
        $peminjaman = Peminjaman::find($id);

        if ($request->has('acc') === true) {
            $peminjaman->is_active = $request->get('acc');
            $peminjaman->peminjaman_user_acc = $request->get('user');
        }
        if ($request->has('kembali')) {
            $peminjaman->is_active = $request->get('kembali');
        }
        $peminjaman->update();

        return redirect(url('/peminjaman/' . $id . '/detail'));
    }
}
