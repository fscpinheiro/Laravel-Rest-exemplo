<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\Cliente;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //return false; //Ignorando ACL
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //Função Local para reprimir o inicio de uma String com numeros
        $NIN = function ($attribute, $value, $fail) {
            if (is_numeric(substr($value, 0, 1))) {
                $fail(ucfirst($attribute) . ' não pode começar com um número.');
            }
        };
        //Regras 
        $regras = [
            'cpf' => [
                'required',
                "unique:clientes",
                function($attribute, $value, $fail){
                    if(!preg_match('/^[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}$/', $value)){
                        $fail('Verifique os digitos do CPF!');
                    }
                    //if(!cpf_check($value)){
                    //    $fail('Este CPF não é valido!');
                    //}
                }
            ],
            'nome' => 'required|min:3|max:120',
            //supondo que apenas clientes com mais de 18 anos e menores de 100 anos possam contratar o serviço
            'nascimento' => 'required|date|before_or_equal:-18 years|after_or_equal:-100 years', 
            'sexo' => 'nullable|in:M,F',
            'endereco' => 'nullable|max:255',
            'estado' => ['nullable',$NIN],
            'cidade' => ['nullable',$NIN]
        ];

        if($this->method() === 'PATCH'){
            $index = array_search('unique:clientes', $regras['cpf']);
            if ($index !== false) {
                array_splice($regras['cpf'], $index, 1);
            }
            $regras['cpf'][] = Rule::unique('clientes')->ignore($this->id);
        }


        return $regras;
    }
}
