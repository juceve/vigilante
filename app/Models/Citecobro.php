<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Citecobro
 *
 * @property $id
 * @property $correlativo
 * @property $gestion
 * @property $cite
 * @property $fecha
 * @property $fechaliteral
 * @property $cliente
 * @property $cliente_id
 * @property $representante
 * @property $mescobro
 * @property $factura
 * @property $monto
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Citecobro extends Model
{

  static $rules = [
    'correlativo' => 'required',
    'gestion' => 'required',
    'cite' => 'required',
    'fecha' => 'required',
    'fechaliteral' => 'required',
    'cliente' => 'required',
    'representante' => 'required',
    'mescobro' => 'required',
    'confactura' => 'required',
    'factura' => 'required',
    'monto' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['correlativo', 'gestion', 'cite', 'fecha', 'fechaliteral', 'cliente', 'cliente_id', 'representante', 'mescobro', 'confactura', 'factura', 'monto', 'estado'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function cliente_data()
  {
    return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
  }
}
