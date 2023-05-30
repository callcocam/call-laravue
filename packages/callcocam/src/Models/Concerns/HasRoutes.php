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


    public function getActionsAttribute()
    {
        return [
            $this->getDataRoute('show'),
            $this->getDataRoute('edit'),
            $this->getDataRoute('destroy'),
        ];
    }

    public function getEditRouterAttribute()
    {
        return $this->getDataRoute('edit');
    }


    public function getShowRouterAttribute()
    {
        return $this->getDataRoute('show');
    }

    public function getDestroyRouterAttribute()
    {
        return $this->getDataRoute('destroy');
    }


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
