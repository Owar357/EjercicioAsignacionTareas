<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        $tarea = Tarea::with('usuario')->get();
        return $tarea;
        } catch (\Exception $e) {
            return $e-> getMessage();
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
            $tarea = new Tarea();

            $tarea -> titulo = $request -> titulo;
            $tarea -> descripcion = $request -> descripcion;
            $tarea -> usuario_id = $request -> usuario_id;

            if($tarea -> save())
            {
                return response()-> json(['status' => 'ok', 'data' => $tarea, 'message' => 'La tarea se creo con exito' ],201);
            }
            else
            {
                return response()->json(['status' => 'fail', 'data' => $tarea, 'message' => 'ocurrio un error al intertar guardar los datos' ],400);
            }    
        } catch (QueryException $Q) {
            return response()->json(['status' => 'fail','message' => 'Ocurrio un problema en la base de datos. Se ha generado un SQLexception: '. $Q -> getMessage() ],400);
            
        }       

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
        $tarea = Tarea::with('usuario')->findOrFail($id);
        
        return $tarea;

        } catch (QueryException $q) {
            return response()->json(['status' => 'fail', 'message' => 'ocurrio un error en la base datos'. $q -> getMessage()]);
        }
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
        try {
        $tarea = Tarea::findOrFail($id);

        $tarea -> titulo = $request -> titulo; 
        $tarea -> descripcion = $request -> descripcion;
        $tarea -> usuario_id = $request -> usuario_id;

        if($tarea -> update())
        {
           return response()->json(['status' => 'ok', 'message' => 'La tarea se a actualizado',],200);
        }

        } catch (QueryException $Q) {
            return response()->json(['status' => 'error', 'message' => 'Se generado un error desde la base de datos: '. $Q ->getMessage() ]);
        }
    }


    public function changeState(Request $request )
    {
      try {
        $tarea = Tarea::findOrFail($request -> id);

        if($tarea -> estatus == 'P')
        {
             $tarea -> estatus = 'F';        
        }  
        if($tarea -> update())
        {
           return response()->json(['status' => 'ok', 'data' => $tarea , 'message se ha actualizado con exito'], 200);
        }
      } catch (QueryException $q) {
         return response()-> json(['status' => 'error', 'message' => 'se ha producido un error en la base de datos'. $q->getMessage()]);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
         $tarea = Tarea::findOrFail($id);

        if($tarea -> delete() )
        {
          return response()->json(['status' => 'ok', 'message' => 'se elimino correctamente'],200);
        }
          return response()->json(['status' => 'fail', 'message' => 'El id que se trata de eliminar, NO EXISTE  '],200);
        } catch (QueryException $q) {
            return response()->json(['status' => 'error', 'message' => 'Ocurrio en la base de datos : '. $q -> getMessage()],200);
        }
    }
}
