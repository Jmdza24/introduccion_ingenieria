<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'identificacion',
        'celular',
        'tipo_visitante',
        'oficio'
    ];

    // Un visitante puede tener muchas visitas
    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}
