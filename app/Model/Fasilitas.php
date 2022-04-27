<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Fasilitas extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'fasilitas_id';
    protected $table = 'fasilitas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fasilitas_id', 'kode_fasilitas', 'nama_fasilitas',
    ];
}
