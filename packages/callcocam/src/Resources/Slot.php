<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace SIGA\Resources;

use SIGA\Resources\Columns\Field;
use SIGA\Resources\Fluent;
use SIGA\Resources\Traits\WithDecorator;
use Illuminate\Support\Str;

class Slot extends Fluent
{
    use WithDecorator;

    /**
     * $columns []
     * $span string
     * $name default|left|rigth
     */
    public function __construct(array $columns, string $span = 'col-span-12', string $name = 'default')
    {
        $this->attributes =  [
            'slot' => $name,
            'span' => [$span],
            'childrens' => $columns
        ];
    }

    public static function blank()
    {
        $slot = new static([]);

        return $slot;
    }

    public static function make(array $columns, string $span = 'col-span-12', string $name = 'default')
    {
        $slot = new static($columns, $span, $name);

        return $slot;
    }

    public function slot($slot = "default")
    {
        $this->offsetSet('slot', $slot);

        return $this;
    }


    public function timestamps($options = [])
    {
        $timestampsOptions = array_merge([
            'label' => 'Data de criação',
            'name' => 'created_at',
        ], $options);

        $label = data_get($timestampsOptions, 'label');
        $name = data_get($timestampsOptions, 'name');

        if (data_get($options, 'created', true))
            $this->mergeOptions(Field::date($label, $name), $options);

        $timestampsOptions = array_merge([
            'label' => 'Data de atualização',
            'name' => 'updated_at',
        ], $options);

        $label = data_get($timestampsOptions, 'label');
        $name = data_get($timestampsOptions, 'name');

        if (data_get($options, 'updated', true))
            $this->mergeOptions(Field::date($label, $name), $options);

        return $this;
    }

    public function hasMany(string $model, $options = [])
    {

        if (class_exists($model)) {

            $class = Str::afterLast($model, '\\');

            $name = Str::lower(sprintf("%s_id", $class));

            $alias = data_get($options, 'alias', Str::lower(sprintf("%s.name", $class)));

            $label = data_get($options, 'label', Str::plural($class));

            $values_options = app($model)->query()->pluck(data_get($options, 'target', 'name'), data_get($options, 'key', 'id'))->toArray();

            $this->mergeOptions(Field::select($label, $name, $values_options)->alias($alias), $options);
        }

        return $this;
    }

    public function editor($options = [])
    {
        $editorOptions = array_merge([
            'label' => 'Conteudo',
            'name' => 'content',
        ], $options);

        $label = data_get($editorOptions, 'label');
        $name = data_get($editorOptions, 'name');

        $this->mergeOptions(Field::editor($label, $name, data_get($options, 'options', [])),array_merge([
            'hideList'=>true
        ], $options));

        return $this;
    }

    public function select($label, $name = null, $options = [])
    {

        $this->mergeOptions(Field::select($label, $name, data_get($options, 'options', [])), $options);

        return $this;
    }

    public function submit($label = 'SALVAR')
    {
        $this->add(Field::submit($label));

        return $this;
    }

    public function filemanager($label = 'File Manager', $options = [])
    {
        $fileManagerOptions = array_merge([
            'label' => 'File Manager',
            'name' => 'file_manager_id',
            'alias' => 'filemanager',
        ], $options);

        $label = data_get($fileManagerOptions, 'label');
        $name = data_get($fileManagerOptions, 'name');
        $alias = data_get($fileManagerOptions, 'alias');

        $this->mergeOptions(Field::filemanager($label, $name)
            ->alias($alias)->model($alias), $options);

        return $this;
    }

    public function status($options = [])
    {
        $statusOptions = array_merge([
            'label' => 'Status',
            'name' => 'status',
        ], $options);

        $values_options = data_get($options, 'values_options', [
            'draft' => 'Draft',
            'published' => 'Published',
        ]);

        $label = data_get($statusOptions, 'label');
        $name = data_get($statusOptions, 'name');

        $this->mergeOptions(Field::status($label, $name, $values_options), $options);

        return $this;
    }


    public function add(Field $column)
    {
        $columns = $this->get('childrens', []);
        $columns[] = $column;

        $this->offsetSet('childrens', $columns);

        return $this;
    }

    private function mergeOptions(Field $field, $options = [])
    {
        $field
            ->ordering(data_get($options, 'ordering', false))
            ->hideList(data_get($options, 'hideList', false))
            ->hideCreate(data_get($options, 'hideCreate', false))
            ->hideEdit(data_get($options, 'hideEdit', false))
            ->hideShow(data_get($options, 'hideShow', false));

        $this->add($field);
        return $this;
    }
}
