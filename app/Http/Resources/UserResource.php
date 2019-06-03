<?php

namespace App\Http\Resources;

use App\Area;
use App\TipoUsuario;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'login' => $this->login,
            //'senha' => $this->senha,
            'matricula' => $this->matricula,
            'cartao' => $this->cartao,
            'nome' => $this->nome,
            'email' => $this->email,
            /*'area' => Area::find($this->area_id),*/
            'tipoUsuario' => TipoUsuario::find($this->tipoUsuario),

            //'cidades' => Cidade::where('estado_id', $this->id)->get(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];

        //return parent::toArray($request);
    }
}
