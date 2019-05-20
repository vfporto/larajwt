<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoUsuario;

//use App\Http\Controllers\Controller;


class TipoUsuariosController extends Controller
{
    public function index(){
        $lista = TipoUsuario::all();

        return response()->json($lista);
    }

    public function show($id){
        $tipo = TipoUsuario::find($id);

        if(!$tipo) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }
        return response()->json($tipo);
    }
    //public function create(){ }
    public function store(Request $request){
        $tipo = new TipoUsuario();
        $tipo->fill($request->all());
        $tipo->save();

        return response()->json($tipo);
    }


    //public function edit($id){ }
    public function update(Request $request, $id){
        $tipo = TipoUsuario::find($id);

        if(!$tipo) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }

        $tipo->fill($request->all());
        return response()->json($tipo);
    }

    public function destroy($id){
        $tipo = TipoUsuario::find($id);
        if(!tipo){
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }
        $tipo->delete();
    }


}
