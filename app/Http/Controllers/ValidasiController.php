<?php


namespace App\Http\Controllers;


use App\Model\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidasiController extends Controller
{
    private function ifNull($data, $return)
    {
        if ($data === NULL) {
            $data = $return;
        }
        return $data;
    }

    public function cekTanggal(Request $request)
    {
        $tanggalAwal = $request->get('tanggalAwal');
        $tanggalAkhir = $request->get('tanggalAkhir');
//        $query = Peminjaman::where('peminjaman_tgl_awal', '=', $tanggal)->get()->toArray();
        $query = DB::table('peminjaman')
            ->where('peminjaman_tgl_awal', '>=', $tanggalAwal)
            ->where('peminjaman_tgl_akhir', '<=', $tanggalAkhir)
            ->get()->toArray();
        if (empty($query) !== true) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }


}
