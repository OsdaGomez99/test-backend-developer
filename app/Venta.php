<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_vendedor',
        'id_cliente',
        'id_sucursal',
        'fecha_venta',
        'monto_total',
    ];

    public function vendedor ()
    {

    }

    public function cliente ()
    {

    }

    public function sucursal ()
    {

    }

    public function detalles_venta ()
    {
        
    }
}
