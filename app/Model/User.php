<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * Function to get all the data for the login information.
     *
     * @param $username
     * @param $password
     * @return array
     */
    public function getLoginData($username, $password): array
    {
        $result = [];
        $wheres = [];
        $wheres[] = "(us.username = '" . $username . "')";
        $wheres[] = '(us.deleted_at IS NULL)';
        $strWhere = ' WHERE ' . implode(' AND ', $wheres);
        $query = 'SELECT us.user_id, us.name, us.username, us.password, us.role, us.deleted_at
                    FROM users as us ' . $strWhere;
        $sqlResult = DB::select($query);
        if (count($sqlResult) === 1) {
            $arrData = $sqlResult[0];
            if (Hash::check($password, $arrData->password) === true) {
               $result = [
                    'user_id' => $arrData->user_id,
                    'name' => $arrData->name,
                    'username' => $arrData->username,
                    'password' => $arrData->password,
                    'role' => $arrData->role
                ];
            }
        }
        return $result;
    }

}
