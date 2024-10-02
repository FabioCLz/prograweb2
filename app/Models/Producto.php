<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Agrega los campos que quieres permitir para la asignación masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        // Si tienes otros campos, agrégales aquí también
    ];
}
