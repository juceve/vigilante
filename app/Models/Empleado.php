<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property $id
 * @property $nombres
 * @property $apellidos
 * @property $cedula
 * @property $direccion
 * @property $telefono
 * @property $correo
 * @property $area_id
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Area $area
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empleado extends Model
{

    static $rules = [
        'nombres' => 'required',
        'apellidos' => 'required',
        'cedula' => 'required|min:3',
        'direccion' => 'required',
        'telefono' => 'required',
        'email' => 'required|email|unique:users',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombres', 'apellidos', 'cedula', 'direccion', 'telefono', 'email', 'area_id', 'user_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function area()
    {
        return $this->hasOne('App\Models\Area', 'id', 'area_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
