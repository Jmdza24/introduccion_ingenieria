<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitante_id',
        'apartamento_id',
        'fecha_ingreso',
        'hora_ingreso',
        'fecha_salida',
        'hora_salida',
    ];

    // Relación con el visitante
    public function visitante()
    {
        return $this->belongsTo(Visitante::class);
    }

    // Relación con apartamento
    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class);
    }
}
