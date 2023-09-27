<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'nrodocumento' => 'required',
		'direccion' => 'required',
		'uv' => 'required',
		'manzano' => 'required',
		'latitud' => 'required',
		'longitud' => 'required',
		'personacontacto' => 'required',
		'telefonocontacto' => 'required',
		'oficina_id' => 'required',
		'observaciones' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['nombre','tipodocumento_id','nrodocumento','direccion','uv','manzano','latitud','longitud','personacontacto','telefonocontacto','oficina_id','observaciones'];

    public function oficina()
    {
        return $this->hasOne('App\Models\Oficina', 'id', 'oficina_id');
    }

    public function tipodocumento()
    {
        return $this->hasOne('App\Models\Tipodocumento', 'id', 'tipodocumento_id');
    }
    

}
