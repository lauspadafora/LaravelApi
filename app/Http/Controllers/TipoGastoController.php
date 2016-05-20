<?php

namespace App\Http\Controllers;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TipoGasto;
use DB;

class TipoGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $tiposgastos = DB::table('tipos_gastos as tg')
            ->leftJoin('users as u1', 'u1.id', '=', 'tg.created_by')
            ->leftJoin('users as u2', 'u2.id', '=', 'tg.updated_by')
            ->select('tg.id', 'tg.nombre', 'tg.created_at', 'tg.updated_at', 'u1.email as created_by', 'u2.email as updated_by')
            ->whereNull('tg.deleted_at')
            ->get();
        return response()->json(['tiposgastos' => $tiposgastos], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {      
        $jsonObj = $request->tipogasto;

        if (!$jsonObj['nombre'])
        {            
            return response()->json(['errors'=>array(['code'=>422, 'message'=>'Missing data.'])], 422);
        }

        $tipogasto = new TipoGasto();
        $tipogasto->nombre = $jsonObj['nombre'];        
        $tipogasto->created_by = Authorizer::getResourceOwnerId();
        $tipogasto->updated_by = Authorizer::getResourceOwnerId();
        $tipogasto->save();

        return response()->json(['tipogasto' => $tipogasto], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipogasto = TipoGasto::where('id',  $id)->first();
        return response()->json(['tipogasto' => $tipogasto], 200);
    }
}
