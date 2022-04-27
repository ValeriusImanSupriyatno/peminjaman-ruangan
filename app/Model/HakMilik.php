<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class HakMilik extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'hak_id';
    protected $table = 'hak_milik';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hak_id', 'kode_hak', 'nama_hak',
    ];
}
