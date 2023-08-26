<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id'=>$this->id,
            'nome'=>$this->nome,
            'cpf'=>$this->cpf,
            'nascimento'=>Carbon::make($this->nascimento)->format('Y-m-d'),
            'sexo'=>$this->sexo,
            'estado'=>$this->estado,
            'cidade'=>$this->cidade,
            'endereco'=>$this->endereco

        ];
    }
}
