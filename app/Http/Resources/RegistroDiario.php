<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Usuario;
use App\Registro;
use App\Ocorrencia;

class RegistroDiario extends JsonResource
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
            'data' => $this->data,

            'usuario' => Usuario::find($this->usuario),
            'registros' => Registro::where('registro_diario_id', $this->id)->get(),
            'ocorrencias' => Ocorrencia::where('registro_diario_id', $this->id)->get(),

            //'cidades' => Cidade::where('estado_id', $this->id)->get(),
            /*'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at*/
        ];

        //return parent::toArray($request);

        //return parent::toArray($request);
    }
}
