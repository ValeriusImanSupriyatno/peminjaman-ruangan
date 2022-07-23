<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Ruangan extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'ruangan_id';
    protected $table = 'ruangan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ruangan_id',
        'ruangan_hak_id',
        'ruangan_kategori_id',
        'kode_ruangan',
        'nama_ruangan',
        'deskripsi_ruangan',
        'is_active',
    ];

    public function loadDataAll()
    {
        $list = DB::table('ruangan', 'rm')
            ->join('hak_milik as hm', 'rm.ruangan_hak_id', '=', 'hm.hak_id')
            ->join('kategori_ruangan as kr', 'rm.ruangan_kategori_id', '=', 'kr.kategori_id')
            ->select(['rm.ruangan_id', 'rm.ruangan_hak_id', 'rm.ruangan_kategori_id', 'rm.kode_ruangan', 'rm.nama_ruangan',
                'rm.deskripsi_ruangan', 'rm.is_active', 'hm.kode_hak', 'hm.nama_hak', 'kr.kode_kategori', 'kr.nama_kategori',
                'rm.kapasitas']);

        $list->whereNull('rm.deleted_at');

        return $list->get();

    }

    public function getDataById($id)
    {
        $query = DB::table('ruangan', 'rm')
            ->join('hak_milik as hm', 'rm.ruangan_hak_id', '=', 'hm.hak_id')
            ->join('kategori_ruangan as kr', 'rm.ruangan_kategori_id', '=', 'kr.kategori_id')
            ->select(['rm.ruangan_id', 'rm.ruangan_hak_id', 'rm.ruangan_kategori_id', 'rm.kode_ruangan', 'rm.nama_ruangan',
                'rm.deskripsi_ruangan', 'rm.is_active', 'hm.kode_hak', 'hm.nama_hak', 'kr.kode_kategori', 'kr.nama_kategori',
                'rm.kapasitas'])
            ->where('rm.ruangan_id', '=', $id)
            ->get()->toArray();
        return $query[0];
    }
}
