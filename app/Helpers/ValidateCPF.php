<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Log;

if (!function_exists('ValidateCPF')) {
    function ValidateCPF($cpf) {
        // Remove caracteres não numéricos do CPF
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        
        // Verifica se o CPF possui 11 caracteres
        if (strlen($cpf) != 11) {
            return false;
        }
        
        // Verifica se todos os digitos são iguais para invalidar 
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        
        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += intval($cpf[$i]) * (10 - $i);
        }
        $resto = $soma % 11;
        $dv1 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += intval($cpf[$i]) * (11 - $i);
        }
        $resto = $soma % 11;
        $dv2 = ($resto < 2) ? 0 : 11 - $resto;
        
        // Verifica se os dígitos verificadores calculados coincidem com os do CPF
        if ($dv1 != intval($cpf[9]) || $dv2 != intval($cpf[10])) {
            return false;
        }
        
        return true;
    }
}
