<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apartamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'torre_id',
        'numero',
    ];

    public function torre()
    {
        return $this->belongsTo(Torre::class);
    }

    public function residentes()
    {
        return $this->hasMany(Residente::class);
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}
