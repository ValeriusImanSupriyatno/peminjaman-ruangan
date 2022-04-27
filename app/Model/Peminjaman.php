<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{
    use Notifiable;

    protected $primaryKey = 'peminjaman_id';
    protected $table = 'peminjaman';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'peminjaman_id',
        'peminjaman_ruangan_id',
        'peminjaman_user_peminjam',
        'peminjaman_user_acc',
        'peminjaman_kode',
        'peminjaman_tgl_awal',
        'peminjaman_tgl_akhir',
        'peminjaman_jam_awal',
        'peminjaman_jam_akhir',
        'peminjaman_kegiatan',
        'peminjaman_deskripsi',
        'is_active',
    ];

    public function getAll()
    {
        $query = DB::table('peminjaman', 'pm')
            ->join('ruangan as r', 'pm.peminjaman_ruangan_id', '=', 'r.ruangan_id')
            ->select(['peminjaman_id',
                'pm.peminjaman_ruangan_id',
                'pm.peminjaman_user_peminjam',
                'pm.peminjaman_user_acc',
                'pm.peminjaman_kode',
                'pm.peminjaman_tgl_awal',
                'pm.peminjaman_tgl_akhir',
                'pm.peminjaman_jam_awal',
                'pm.peminjaman_jam_akhir',
                'pm.peminjaman_kegiatan',
                'pm.peminjaman_deskripsi',
                'pm.is_active',
                'r.nama_ruangan',
            ]);
        return $query->get();
    }

    public function getById($id)
    {
        $query = DB::table('peminjaman', 'pm')
            ->join('ruangan as r', 'pm.peminjaman_ruangan_id', '=', 'r.ruangan_id')
            ->select(['pm.peminjaman_id',
                'pm.peminjaman_ruangan_id',
                'pm.peminjaman_user_peminjam',
                'pm.peminjaman_user_acc',
                'pm.peminjaman_kode',
                'pm.peminjaman_tgl_awal',
                'pm.peminjaman_tgl_akhir',
                'pm.peminjaman_jam_awal',
                'pm.peminjaman_jam_akhir',
                'pm.peminjaman_telp',
                'pm.peminjaman_kegiatan',
                'pm.peminjaman_deskripsi',
                'pm.is_active',
                'r.nama_ruangan',
            ])
            ->where('peminjaman_id', '=', $id)
            ->get()->toArray();
        return $query[0];
    }


    public static function getKalender()
    {
        $query = DB::table('peminjaman', 'pm')
            ->join('ruangan as r', 'pm.peminjaman_ruangan_id', '=', 'r.ruangan_id')
            ->select([
                'pm.peminjaman_tgl_awal',
                'pm.peminjaman_tgl_akhir',
                'pm.peminjaman_jam_awal',
                'pm.peminjaman_jam_akhir',
                'pm.peminjaman_kegiatan',
                'r.nama_ruangan',
                'r.kode_ruangan',
            ])
            ->whereNotNull('pm.is_active');
        return $query->get();
    }
}
