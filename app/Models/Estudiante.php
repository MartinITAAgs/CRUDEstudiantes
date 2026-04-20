<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'semestre', 
        'carrera_id',
    ];

    //relación con Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}