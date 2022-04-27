<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class KategoriRuangan extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'kategori_id';
    protected $table = 'kategori_ruangan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kategori_id', 'kode_kategori', 'nama_kategori',
    ];
}
