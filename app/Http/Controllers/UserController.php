<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

use App\User;
//use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function index(){
        //$lista = User::with(['tipoUsuario', 'area'])->get();
        //return response()->json($lista);
        return UserResource::collection(User::orderBy('nome')->paginate());
    }




    public function show($id){
       // $user = User::with(['tipoUsuario', 'area'])->find($id);

        //if(!$user) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        //return response()->json($user);

        return new UserResource(User::find($id));
    }





    public function store(Request $request){
        $user = new User();
        $user->fill($request->all());

        if (!$request->filled('tipo_usuario_id'))
            $user->fill(['tipo_usuario_id' => $request->input('tipoUsuario.id')]);

            //mudou essa merda
            /*if (!$request->filled('area_id'))
            $user->fill(['area_id' => $request->input('area.id')]);*/

       if($user->save()){
           return response()->json(new UserResource($user),201);
       }
        return response()->json(new UserResource($user),400);

       // return response()->json($user, 201);

    }






    public function update(Request $request, $id){
        $user = User::find($id);

        if(!$user) { return response()->json(['erro' => 'Registro não encontrado'], 404); }

        $user->fill($request->all());

        if (!$request->filled('tipo_usuario_id'))
            $user->fill(['tipo_usuario_id' => $request->input('tipoUsuario.id')]);

        /*if (!$request->filled('area_id'))
            $user->fill(['area_id' => $request->input('area.id')]);*/

        $user->save();

        //return response()->json($user);
        return response()->json(new UserResource($user),201);
    }

    public function destroy($id){
        $user = User::find($id);

        if(!$user) {
            return response()->json(['erro' => 'Registro não encontrado'], 404);
        }

        $user->delete();
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
