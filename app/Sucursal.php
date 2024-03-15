<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    protected $primaryKey = 'id';

    protected $fillable = [
        'pais',
        'moneda',
    ];

    public function productos ()
    {

    }

    public function ventas ()
    {
        
    }
}
