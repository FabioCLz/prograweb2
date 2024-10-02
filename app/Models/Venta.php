<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = [
        'user_id',
        'producto_id',
        'precio',
        'clave', // Añadir clave aquí
        'fecha_compra',
    ];
    
}
