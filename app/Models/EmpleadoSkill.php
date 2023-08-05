<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        "skill",
        "evaluacion"
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,"id_usuario", "id");
    }
}
