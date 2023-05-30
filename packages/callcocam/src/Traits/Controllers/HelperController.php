<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Traits\Controllers;

use Illuminate\Support\Facades\Route;

/**
 * HelperController
 */
trait HelperController
{

  
    protected function FOUNSuccess($result, $content = "Registro atualizado com sucesso!!")
    {
        return [
            'form_data' => $result,
            'message' => [
                'title' => sprintf('OPPSS!! %s',  data_get($result, 'name')),
                'text' => $content,
                'body' => $content,
                'content' => $content,
                'color' => 'success',
                'variant' => 'success',
                "item" => null,
                "time" => now()->diffForHumans()

            ]
        ];
    }

    protected function PDOError($PDOError)
    {
        return response()->json([
            'error' => [
                'text' => $PDOError->getMessage(),
                "variant" => "error",
                'content' => $PDOError->getMessage(),
                'body' => $PDOError->getMessage(),
                "title" => sprintf("OPPSS!! - %s", $PDOError->getCode()),
                "item" => null,
                "color" => "danger",
                "time" => now()->diffForHumans()
            ]
        ], 500);
    }

    protected function NOTFOUNDrror()
    {
        return response()->json([
            'error' => [
                'title' => 'OPPSS!!',
                'text' => 'Ouve um erro!!, registro não foi encontrado',
                "variant" => "error",
                'content' => "Ouve um erro!!, registro não foi encontrado",
                'body' => "Ouve um erro!!, registro não foi encontrado",
                "item" => null,
                "color" => "danger",
                "time" => now()->diffForHumans()
            ]
        ], 400);
    }
}
