<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      try {
        $usuario = Usuario::All();    
        return $usuario;
      } catch (\Exception $e) {
        return response()->json(['status' => 'fail', 'message' => 'No se pudieron recuperar los datos'],500);
      }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $usuario = new Usuario();

        $usuario->nombre = $request -> nombre;
        $usuario-> fecha_nacimiento = $request -> fecha_nacimiento;
        $usuario->parentesco = $request ->parentesco;
        
        if($usuario -> save())
        {
            return response()->json(['status' => 'ok','data' => $usuario ,'message' => 'Los datos se guardaron correctamente'],200);     
        }
        else
        {
            return response()->json(['status' => 'fail', 'message' => 'Ocurrio un error al guardar los datos'],400);
 
        }
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => 'Ocurrio un error :'. $e],500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
