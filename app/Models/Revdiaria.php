<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Revdiaria
 *
 * @property $id
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Revdiaria extends Model
{
    
    static $rules = [
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha'];



}
