<?php

namespace App\Http\Controllers;

use App\Model\Fasilitas;
use App\Model\Peminjaman;
use App\Model\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamRuanganFiturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $data = [
            'session' => session('user'),
            'fasilitas' => Fasilitas::all(),
        ];
        return view('transaksi.fitur.app', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function filter(Request $request)
    {
        $str_item_pinjam = $request->get('item_fasiltas');
        $itemPinjam = json_decode($str_item_pinjam);
        $implode = implode("','", $itemPinjam);

        if (isset($_POST['proses'])) {
            $data = $this->loadData("'" . $implode . "'");
            echo json_encode($data);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return mixed
     */
    public function transaksiPinjam($id)
    {
        $ruangan = Ruangan::find($id);
        $transaksi = Peminjaman::where('peminjaman_ruangan_id', '=', $id)->orderBy('peminjaman_tgl_awal', 'asc')->paginate(10);
        $data = [
            'session' => session('user'),
            'ruangan' => $ruangan,
            'transaksi' => $transaksi,
        ];
        return view('transaksi.fitur.form', $data);
    }

    private function loadData($id): array
    {
        $query = "SELECT r.ruangan_id, r.kode_ruangan, r.kapasitas, r.nama_ruangan, hk.nama_hak, kt.nama_kategori,
                        (SELECT COUNT(dtr.detru_ruangan_id) AS total
                        FROM detail_ruangan as dtr
                        WHERE dtr.deleted_at IS NULL
                        AND dtr.detru_ruangan_id = r.ruangan_id) as total
                    FROM ruangan as r
                    INNER JOIN detail_ruangan as dr on r.ruangan_id = dr.detru_ruangan_id
                    INNER JOIN fasilitas as f on dr.detru_fasilitas_id = f.fasilitas_id
                    INNER JOIN hak_milik as hk on r.ruangan_hak_id = hk.hak_id
                    INNER JOIN kategori_ruangan as kt on r.ruangan_kategori_id = kt.kategori_id
                    WHERE dr.deleted_at IS NULL
                    AND r.deleted_at IS NULL
                    AND dr.detru_fasilitas_id IN (" . $id . ")
                    GROUP BY r.ruangan_id, hk.nama_hak, kt.nama_kategori,r.kapasitas
                    ORDER BY total DESC";
        return DB::select($query);
    }

    public function store(Request $request)
    {
        $count = Peminjaman::count() + 1;
        $kode = 'PMJ/' . date('Y-m-d') . '/' . $count;

        $pmj = new Peminjaman();
        $pmj->peminjaman_ruangan_id = $request->get('ruangan');
        $pmj->peminjaman_user_peminjam = $request->get('user');
        $pmj->peminjaman_kode = $kode;
        $pmj->peminjaman_tgl_awal = $request->get('tanggalAwal');
        $pmj->peminjaman_tgl_akhir = $request->get('tanggalAkhir');
        $pmj->peminjaman_jam_awal = $request->get('jamMulai');
        $pmj->peminjaman_jam_akhir = $request->get('jamBerakhir');
        $pmj->peminjaman_kegiatan = $request->get('kegiatan');
        $pmj->peminjaman_deskripsi = $request->get('deskripsi');
        $pmj->peminjaman_telp = $request->get('telp');
        $pmj->save();

        return redirect(url('/peminjaman'));
    }


    /**
     * function for dashboard page
     *
     * @return mixed
     */
    public function calender()
    {
        $data = [
            'session' => session('user'),
            'ruangan' => Ruangan::all(),
        ];
        return view('transaksi.calender/calender', $data);
    }
}
