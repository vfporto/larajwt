<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsuarioResource;
use Illuminate\Http\Request;

use App\Usuario;
//use App\Http\Controllers\Controller;


class UsuariosController extends Controller
{
    public function index(){
        //$lista = Usuario::with(['tipoUsuario', 'area'])->get();
        //return response()->json($lista);
        return UsuarioResource::collection(Usuario::paginate());
    }




    public function show($id){
       // $usuario = Usuario::with(['tipoUsuario', 'area'])->find($id);

        //if(!$usuario) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        //return response()->json($usuario);

        return new UsuarioResource(Usuario::find($id));
    }





    public function store(Request $request){
        $usuario = new Usuario();
        $usuario->fill($request->all());

        if (!$request->filled('tipo_usuario_id'))
            $usuario->fill(['tipo_usuario_id' => $request->input('tipoUsuario.id')]);

            //mudou essa merda
            /*if (!$request->filled('area_id'))
            $usuario->fill(['area_id' => $request->input('area.id')]);*/

       if($usuario->save()){
           return response()->json(new UsuarioResource($usuario),201);
       }
        return response()->json(new UsuarioResource($usuario),400);

       // return response()->json($usuario, 201);

    }






    public function update(Request $request, $id){
        $usuario = Usuario::find($id);

        if(!$usuario) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $usuario->fill($request->all());

        if (!$request->filled('tipo_usuario_id'))
            $usuario->fill(['tipo_usuario_id' => $request->input('tipoUsuario.id')]);

        if (!$request->filled('area_id'))
            $usuario->fill(['area_id' => $request->input('area.id')]);

        $usuario->save();

        //return response()->json($usuario);
        return response()->json(new UsuarioResource($usuario),201);
    }

    public function destroy($id){
        $usuario = Usuario::find($id);

        if(!$usuario) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }

        $usuario->delete();
    }
/*
    private function validate($id, $dados){

        $regras = [
            'logradouro' => 'required|max:150',
            'bairo' => 'required|max:50',
            'bairo' => 'max:6',
            'cep' => 'required|max:8',
            'complemento' => 'max:150',
            'referencia' => 'max:150',
            'cidade_id' => 'required|integer|exists:cidades,id'


              'login' => $this->login,
            //'senha' => $this->senha,
            'matricula' => $this->matricula,
            'nome' => $this->nome,
            'email' => $this->email,
            'area' => Area::find($this->area_id),
            'tipoUsuario' => TipoUsuario::find($this->tipoUsuario),
        ];

        $validator = Validator::make($dados, $regras);

        return $validator->errors()->all();

    }
*/
}
