<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class DetailRuangan extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'detru_id';
    protected $table = 'detail_ruangan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detru_id', 'detru_ruangan_id', 'detru_fasilitas_id',
    ];

    public function loadDataByIdRuangan($id)
    {
        return DB::table('detail_ruangan', 'dr')
            ->join('fasilitas as fs', 'dr.detru_fasilitas_id', '=', 'fs.fasilitas_id')
            ->join('ruangan as r', 'dr.detru_ruangan_id', '=', 'r.ruangan_id')
            ->select(['dr.detru_id', 'dr.detru_fasilitas_id', 'dr.detru_ruangan_id', 'dr.detru_jumlah', 'fs.nama_fasilitas'])
            ->whereNull('dr.deleted_at')
            ->where('dr.detru_ruangan_id', '=', $id)
            ->get();
    }
}
