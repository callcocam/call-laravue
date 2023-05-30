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
            $this->getDataRoute('show', [
                'label' => 'Show',
                'color' => 'btn-default',
                'icon' => 'fa-eye'
            ]),
            $this->getDataRoute('edit', [
                'label' => 'Edit',
                'color' => 'btn-default',
                'icon' => 'fa-edit'
            ]),
            $this->getDataRoute('destroy', [
                'label' => 'Trash',
                'color' => 'btn-error',
                'icon' => 'fa-trash-alt'
            ]),
        ];
    }

    public function getEditRouterAttribute()
    {
        return $this->getDataRoute('edit', [
            'label' => 'Edit',
            'color' => 'btn-default',
            'icon' => 'fa-edit'
        ]);
    }


    public function getShowRouterAttribute()
    {
        return $this->getDataRoute('show', [
            'label' => 'Show',
            'color' => 'btn-default',
            'icon' => 'fa-eye'
        ]);
    }

    public function getDestroyRouterAttribute()
    {
        return $this->getDataRoute('destroy', [
            'label' => 'Trash',
            'color' => 'btn-error',
            'icon' => 'fa-trash-alt'
        ]);
    }


    public function getDataRoute($name, $data = [])
    {

        $route = sprintf("%s.%s", $this->getTable(), $name);
        if (Route::has($route)) {
            $params[$this->getKeyName()] = $this->getKey();
            $data['path'] =  route($route, $this);
            $data['route'] =  [
                'name' => $route,
                'params' => $params
            ];
            return $data;
        }
        return null;
    }
}
