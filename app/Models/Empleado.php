<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "email",
        "puesto",
        "fecha_nacimiento",
        "domicilio",
        "domicilio_url",
        "domicilio_latitud",
        "domicilio_longitud"
    ];

    public function skills()
    {
        return $this->hasMany(EmpleadoSkill::class, "id_empleado", "id");
    }
}
