<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Residente extends Model
{
    use HasFactory;

    protected $fillable = [
        'apartamento_id',
        'nombre',
        'identificacion',
        'celular',
    ];

    public function apartamento()
    {
        return $this->belongsTo(Apartamento::class);
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}
