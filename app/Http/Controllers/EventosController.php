<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('welcome');
    }
    public function ObtenerTodosEventos(){
        $Eventos=\App\Models\Evento::all();
        return $Eventos;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


        //obtenemos el campo file definido en el formulario
       $file = $request->file('Imagen');

        if ($request->hasFile('Imagen')){
        $file           = $request->file("Imagen");
        //$nombrearchivo  = str_slug($request->slug).".".$file->getClientOriginalExtension();
        $nombrearchivo  = $file->getClientOriginalName();
        $file->move(public_path("img/categorias/"),$nombrearchivo);
        $EventoNuevo=new \App\Models\Evento;
        $EventoNuevo->idRestaurante=$request->IdRestaurante;
        $EventoNuevo->Imagen=$nombrearchivo;
        $EventoNuevo->Fecha=$request->Fecha;
        $EventoNuevo->NombreEvento=$request->NombreEvento;
        $EventoNuevo->Descripcion=$request->Descripcion;
        $EventoNuevo->State=true;
        $EventoNuevo->save();

    }



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$fecha)
    {
        //
        $Encontrar=DB::table('eventos')
        ->where('eventos.idRestaurante', '=', $id)
        ->where('eventos.Fecha', '=', $fecha)
        ->get();
        return $Encontrar;
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
        //

            $EventoActualizar=\App\Models\Evento::find($id);
            $EventoActualizar->idRestaurante=$request->idRestaurante;
            $EventoActualizar->NombreEvento=$request->NombreEvento;
            $EventoActualizar->Fecha=$request->Fecha;
            $EventoActualizar->Descripcion=$request->Descripcion;
            $EventoActualizar->save();
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
        $EventoEliminar=DB::table('eventos')
        ->where('eventos.id', '=', $id)
        ->delete();
    }
}
