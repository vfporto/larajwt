<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(){
        $lista = TipoUsuario::all();

        return response()->json($lista);
    }

    public function show($id){
        $retorno = Area::find($id);

        if(!$retorno) {return response()->json(['erro' => 'Registro não encontrado'], 404);}
        return response()->json($retorno);
    }

    public function store(Request $request){
        $area = new Area();
        $area->fill($request->all());
        $area->save();

        return response()->json($area);
    }

    public function update(Request $request, $id){
        $retorno = Area::find($id);

        if(!$retorno) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $retorno->fill($request->all());
        return response()->json($retorno);
    }

    public function destroy($id){
        $area = Area::find($id);
        if(!$area){ return response()->json(['erro' => 'Registro não encontrado'], 404); }
        $area->delete();
    }


}
