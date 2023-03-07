<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BrazilAPI
{
    public static function getAddressFromCep(string $cep): array
    {
        $response = HTTP::get('https://brasilapi.com.br/api/cep/v1/'.$cep);

        return $response->json();
    }
}
