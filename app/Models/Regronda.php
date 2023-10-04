<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Regronda
 *
 * @property $id
 * @property $empleado_id
 * @property $designacione_id
 * @property $ctrlpunto_id
 * @property $fecha
 * @property $hora
 * @property $latA
 * @property $lngA
 * @property $created_at
 * @property $updated_at
 *
 * @property Ctrlpunto $ctrlpunto
 * @property Designacione $designacione
 * @property Empleado $empleado
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Regronda extends Model
{
    
    static $rules = [
		'empleado_id' => 'required',
		'designacione_id' => 'required',
		'ctrlpunto_id' => 'required',
		'fecha' => 'required',
		'hora' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['empleado_id','designacione_id','ctrlpunto_id','fecha','hora', 'anotaciones','latA','lngA'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ctrlpunto()
    {
        return $this->hasOne('App\Models\Ctrlpunto', 'id', 'ctrlpunto_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function designacione()
    {
        return $this->hasOne('App\Models\Designacione', 'id', 'designacione_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function empleado()
    {
        return $this->hasOne('App\Models\Empleado', 'id', 'empleado_id');
    }
    

}
