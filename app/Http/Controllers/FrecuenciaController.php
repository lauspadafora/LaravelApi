<?php

namespace App\Http\Controllers;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Frecuencia;
use DB;

class FrecuenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frecuencias = DB::table('frecuencias as f')
            ->leftJoin('users as u1', 'u1.id', '=', 'f.created_by')
            ->leftJoin('users as u2', 'u2.id', '=', 'f.updated_by')
            ->select('f.id', 'f.nombre', 'f.created_at', 'f.updated_at', 'u1.email as created_by', 'u2.email as updated_by')
            ->whereNull('f.deleted_at')
            ->get();
        return response()->json(['frecuencias' => $frecuencias], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $jsonObj = $request->frecuencia;

        if (!$jsonObj['nombre'])
        {            
            return response()->json(['errors'=>array(['code'=>422, 'message'=>'Missing data.'])], 422);
        }

        $frecuencia = new Frecuencia();
        $frecuencia->nombre = $jsonObj['nombre'];        
        $frecuencia->created_by = Authorizer::getResourceOwnerId();
        $frecuencia->updated_by = Authorizer::getResourceOwnerId();
        $frecuencia->save();

        return response()->json(['frecuencia' => $frecuencia], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $frecuencia = Frecuencia::where('id',  $id)->first();
        return response()->json(['frecuencia' => $frecuencia], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $jsonObj = $request->frecuencia;
        $frecuencia = Frecuencia::where('id', $id)->first();

        if (!$frecuencia)
        {            
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Resource not found.'])], 404);
        }

        $frecuencia->nombre = $jsonObj['nombre'];    
        $frecuencia->updated_by = Authorizer::getResourceOwnerId();
        $frecuencia->save();   

        return response()->json(['frecuencia' => $frecuencia], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $frecuencia = Frecuencia::where('id', $id)->first();

        if (!$frecuencia)
        {
            return response()->json(['errors' => array(['code' => 404, 'message' => 'Resource not found.'])], 404);
        }
        else
        {
            $frecuencia->delete();
            return response()->json(['status' => 'OK'], 200);
        }
    }
}
