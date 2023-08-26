<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

use App\Models\Cliente;
use App\Http\Resources\ClienteResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class ClienteController extends Controller
{

    public function __construct(
        protected Cliente $repository,
    ){

    }

    public function index(){

        $clientes = $this->repository::paginate(10);
        return ClienteResource::collection($clientes);
    }

    public function store(ClienteRequest $request){
        //Considera apenas os dados validados
        $data = $request->validated(); 
        $cliente =  $this->repository::create($data);
        return new ClienteResource($cliente);
    }

    public function show(string $id){
        //Forma mais manual
        //$cliente = Cliente::find($id);
        //if(!$cliente){
        //    return response()->json(['message'=>'Cliente não encontrado.'], Response::NOT_FOUND);
        //}
        //Forma mais curta
        $cliente =  $this->repository::findOrFail($id);
        return new ClienteResource($cliente);
    }

    public function update(ClienteRequest $request, string $id){
        $data = $request->validated();
        $cliente =  $this->repository::findOrFail($id);
        $cliente->update($data);
        return new ClienteResource($cliente);
    }
    
    public function destroy(string $id){
        $this->repository::findOrFail($id)->delete();
        //return response()->json([],Response::HTTP_NO_CONTENT);//204    
        response()->noContent();
    }

    public function buscaGeral(Request $request){
        $query =  $this->repository::query();
        if ($request->has('nome')) {
            $query->where('nome', 'like', '%' . $request->input('nome') . '%');
        }
        if ($request->has('cpf')) {
            $query->where('cpf', 'like', '%' . $request->input('cpf') . '%');
        }
        if ($request->has('nascimento')) {
            $query->where('nascimento', '=', $request->input('nascimento'));
        }
        if ($request->has('sexo')) {
            $query->where('sexo', '=', $request->input('sexo'));
        }
        if ($request->has('cidade')) {
            $query->where('cidade', 'like', '%' . $request->input('cidade') . '%');
        }
        if ($request->has('estado')) {
            $query->where('estado', 'like', '%' . $request->input('estado') . '%');
        }
        
       
        $clientes =  $query->paginate(10);
        if ($clientes->isEmpty()) {
            return response()->json(['message' => 'clientes0'], 200);
        }
        return ClienteResource::collection($clientes); 
    }
}
