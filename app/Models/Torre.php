<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Torre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function apartamentos()
    {
        return $this->hasMany(Apartamento::class);
    }
}
