<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Models\Empleado;
use App\Utils\Coordenadas;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();
        return response()->json([
            'status' => true,
            'empleados' => $empleados
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpleadoRequest $request)
    {
        $datos = $request->all();
        $fn = \DateTime::createFromFormat("d/m/Y", $datos["fecha_nacimiento"]);
        $datos["fecha_nacimiento"] = $fn->format("Y/m/d");

        $coordenadas = Coordenadas::getCoordenadas($datos["domicilio"]);

        $datos["domicilio_latitud"] = trim($coordenadas[0]);
        $datos["domicilio_longitud"] = trim($coordenadas[1]);

        $empleado = Empleado::create($datos);

        $empleado->skills()->createMany(
            $datos["skills"]["data"]
        );

        return response()->json([
            'status' => true,
            'message' => "Empleado creado éxitosamente",
            'empleado' => $empleado
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::with("skills")->find($id);
        return response()->json([
            'status' => true,
            'empleado' => $empleado
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
