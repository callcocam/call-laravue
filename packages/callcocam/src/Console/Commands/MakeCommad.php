<?php

/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace SIGA\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

abstract class MakeCommad extends Command
{

    protected $description = 'Make a table and form component for a model';
    /**
     * Reserved names that cannot be used for generation.
     *
     * @var string[]
     */
    protected $reservedNames = [
        '__halt_compiler',
        'abstract',
        'and',
        'array',
        'as',
        'break',
        'callable',
        'case',
        'catch',
        'class',
        'clone',
        'const',
        'continue',
        'declare',
        'default',
        'die',
        'do',
        'echo',
        'else',
        'elseif',
        'empty',
        'enddeclare',
        'endfor',
        'endforeach',
        'endif',
        'endswitch',
        'endwhile',
        'enum',
        'eval',
        'exit',
        'extends',
        'false',
        'final',
        'finally',
        'fn',
        'for',
        'foreach',
        'function',
        'global',
        'goto',
        'if',
        'implements',
        'include',
        'include_once',
        'instanceof',
        'insteadof',
        'interface',
        'isset',
        'list',
        'match',
        'namespace',
        'new',
        'or',
        'print',
        'private',
        'protected',
        'public',
        'readonly',
        'require',
        'require_once',
        'return',
        'static',
        'switch',
        'throw',
        'trait',
        'true',
        'try',
        'unset',
        'use',
        'var',
        'while',
        'xor',
        'yield',
        '__CLASS__',
        '__DIR__',
        '__FILE__',
        '__FUNCTION__',
        '__LINE__',
        '__METHOD__',
        '__NAMESPACE__',
        '__TRAIT__',
    ];

    protected function getStubs($file = 'api'): string
    {
        if (is_string($this->option('template')) && empty($this->option('template')) === false) {
            return File::get(base_path($this->option('template')));
        }
        $stub = match ($file) {
            'api' => File::get(__DIR__ . '/stubs/api-controller.stub'),
            'edit' => File::get(__DIR__ . '/stubs/edit-component.stub'),
            'delete' => File::get(__DIR__ . '/stubs/delete-component.stub'),
            'list' => File::get(__DIR__ . '/stubs/list-component.stub'),
            'show' => File::get(__DIR__ . '/stubs/show-component.stub'),
        };
        return $stub;
    }

    protected function modelExist($modelName, $modelLastName)
    {
        if (!class_exists($modelName)) {
            $model = (bool) $this->confirm('A model <comment>' . $modelName . '</comment> não existe. Você gostaria de criar?');

            if ($model) {
                $this->call('make:model', [
                    'name' => $modelLastName,
                    '-m' => true,
                    '-f' => true,
                    '-s' => true,
                ]);
            }
        }
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }


    /**
     * Checks whether the given name is reserved.
     *
     * @param  string  $name
     * @return bool
     */
    protected function isReservedName($name)
    {
        $name = strtolower($name);

        return in_array($name, $this->reservedNames);
    }
}