<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Models\Concerns;

use Illuminate\Support\Facades\Route;

/**
 * HasRoutes
 */
trait HasRoutes
{

    public function getDataRoute($name)
    {

        $route = sprintf("%s.%s", $this->getTable(), $name);
        if (Route::has($route)) {
            $params[$this->getKeyName()] = $this->getKey();
            return [
                'path' => route($route, $this),
                'route' => [
                    'name' => $route,
                    'params' => $params
                ]
            ];
        }
        return null;
    }
}
