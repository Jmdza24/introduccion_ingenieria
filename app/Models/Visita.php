<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartamento_id',
        'nombre_visitante',
        'identificacion',
        'fecha_ingreso',
        'hora_ingreso',
        'fecha_salida',
        'hora_salida',
    ];

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class);
    }
}
