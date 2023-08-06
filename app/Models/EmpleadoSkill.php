<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpleadoSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_empleado",
        "skill",
        "evaluacion"
    ];

    protected $table = 'empleados_skills';

    public function empleado()
    {
        return $this->belongsTo(Empleado::class,"id_empleado", "id");
    }
}
