<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use App\Resources\Make\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PDOException;
use SIGA\Traits\Controllers\HelperController;

class AbstractController extends BaseController
{
    use HelperController;

    protected $model;

    protected $resourse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($this->resourse) {
            if ($resourse = app($this->resourse)) {
                try {
                    $data = array_merge(
                        $resourse->init($this->model, 'makes')->icon('fa-layer-group')->toArray(),
                        app($this->model)->query()->filter($request, $resourse->filters)->paginate($request->query('perPage', 12))->toArray()
                    );
                    return response()->json($data);
                } catch (\Exception $ex) {
                    return $this->PDOError($ex);
                }
            }
        }
        return $this->NOTFOUNDrror();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($this->resourse) {
            if ($resourse = app($this->resourse)) {
                try {
                    return response()->json($resourse->init($this->model, 'makes')->icon('fa-layer-group')->toArray());
                } catch (\Exception $ex) {
                    return $this->PDOError($ex);
                }
            }
        }
        return $this->NOTFOUNDrror();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($this->model) {
            if ($model = app($this->model)) {
                $data = $request->input();
                $request->validate($this->rules($request, $model));
                try {
                    $model = $model->create($data);
                    if ($model) {
                        //Upload action
                    }
                    $result =  $model->toArray();
                    return response()->json($this->FOUNSuccess($result, "Registro criado com sucesso!!"), 201);
                } catch (PDOException $PDOError) {
                    return $this->PDOError($PDOError);
                }
            }
        }

        return $this->NOTFOUNDrror();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($this->model) {
            if ($model = app($this->model)::find($id)) {
                try {
                    return response()->json($model->toArray());
                } catch (PDOException $PDOError) {
                    return $this->PDOError($PDOError);
                }
            }
        }
        return $this->NOTFOUNDrror();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($this->resourse) {
            if ($resourse = app($this->resourse)) {
                if ($this->model) {
                    if ($model = app($this->model)::find($id)) {
                        try {
                            $data = $resourse->init($this->model)->icon('fa-layer-group');
                            $data['data'] = $model->toArray();
                            return  $data;
                        } catch (PDOException $PDOError) {
                            return $this->PDOError($PDOError);
                        }
                    }
                }
            }
        }
        return $this->NOTFOUNDrror();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->model) {
            if ($model = app($this->model)::find($id)) {
                $data = $request->input();
                $request->validate($this->rules($request, $model));
                try {
                    $model->update($data);
                    if ($model) {
                        // $this->appendAction($model,  $request->all());
                    }
                    $result =  $model->toArray();
                    return response()->json($this->FOUNSuccess($result), 201);
                } catch (PDOException $PDOError) {
                    return $this->PDOError($PDOError);
                }
            }
        }
        return $this->NOTFOUNDrror();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($this->model) {
            if ($model = app($this->model)::find($id)) {
                try {
                    $model->delete();
                    return response()->json($this->FOUNSuccess($model, "Registro excluido com sucesso!!"), 201);
                } catch (PDOException $PDOError) {
                    return $this->PDOError($PDOError);
                }
            }
        }
        return $this->NOTFOUNDrror();
    }


    public function route($path)
    {
        $params[$path] = 'id';

        Route::resource($path, static::class)->parameters($params);
    }


    protected function rules(Request $request, $model)
    {
        return [];
    }
}
