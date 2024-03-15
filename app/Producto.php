<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre_pro',
        'precio_pro',
        'id_sucursal',
    ];

    public function sucursal ()
    {

    }

    public function detalles_ventas ()
    {
        
    }
}
