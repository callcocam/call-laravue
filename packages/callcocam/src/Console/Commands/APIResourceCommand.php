<?php

/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace SIGA\Console\Commands;


use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\{Arr, Str};

class APIResourceCommand extends MakeCommad
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api-resource {name} {--template= : nome para o resource stub}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um resource perssonalizado';

    


    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Resource';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name       = $this->getNameInput();

        if (!is_string($name)) {
            throw new \Exception('Could not parse table name');
        }

        // First we need to ensure that the given name is not a reserved word within the PHP
        // language and that the class name will actually be valid. If it is not valid we
        // can error now and prevent from polluting the filesystem using invalid files.
        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "' . $this->getNameInput() . '" is reserved by PHP.');

            return false;
        }

        $resourceName       = sprintf("%s%s", $name, $this->type);

        $resourceName = str_replace(['.', '\\'], '/', (string) $resourceName);

        $stub = $this->getStubs('resource');

        $resourceName      = '';
        $resourceLastName  = '';
        $resourceName = $this->ask('Insira o caminho do seu resourceo (E.g., <comment>App\Models\User ou User</comment>)');
        if (!is_string($resourceName)) {
            throw new \Exception('Could not parse table name');
        }
        $modelName      = $resourceName;
        if (!Str::contains($modelName, "\\")) {
            $modelName = sprintf("App\\Models\\%s", $modelName);
        }
        if (!Str::contains($resourceName, "\\")) {
            $resourceName = sprintf("App\\Resources\\Make\\%sResource", $resourceName);
        } 

        $resourceNameArr = [];

        preg_match('/(.*)(\/|\.|\\\\)(.*)/', $resourceName, $matches);

        if (!is_array($matches)) {
            throw new Exception('Could not parse resource name');
        }

        $resourceNameArr  = explode('\\', $resourceName);
        $resourceLastName = Arr::last($resourceNameArr);

        if (empty($resourceName)) {
            $this->error('Could not create, Model path is missing');
        }
        
        $modelNameArr  = explode('\\', $modelName);
        $modelLastName = Arr::last($modelNameArr);

        $this->modelExist($modelName, $modelLastName);

        $resourceName   = $resourceName;
        $subFolder       = '';

        if (!empty($matches)) {
            $resourceName = end($matches);
            array_splice($matches, 2);
            $subFolder = '\\' . str_replace(['.', '/', '\\\\'], '\\', end($matches));
        }
        if (!is_string($resourceName)) {
            throw new \Exception('Could not parse resource name');
        }

        if (!is_string($subFolder)) {
            throw new \Exception('Could not parse subfolder name');
        }

        $resource_name = Str::of($resourceName)
            ->lower()
            ->kebab()
            ->replace('/', '.')
            ->replace('\\', '.')
            ->replace('table', '-table')
            ->prepend('<resource:')
            ->append('/>');


        $appPath  = 'App\\';
        $resourcePath  = 'Resources/Make/';

        $path          = app_path($resourcePath . $resourceName . '.php');

        $filename  = Str::of($path)->basename();

        $basePath  = Str::of($path)->replace($filename, '');

        $savedAt   = $resourcePath . $basePath->after($resourcePath);

        $Namespace = $appPath . str_replace(['.', '/', '\\\\'], '\\', $savedAt);

        $Namespace = Str::beforeLast($Namespace, '\\');

        $stub = str_replace('{{ subFolder }}', $subFolder, $stub);
        $stub = str_replace('{{ resourceName }}', $resourceName, $stub);
        $stub = str_replace('{{ resourceNamespace }}', $Namespace, $stub);
        $stub = str_replace('{{ resourceLastName }}', $resourceLastName, $stub);
        $stub = str_replace('{{ resourceLowerCase }}', Str::lower($resourceLastName), $stub);
        $stub = str_replace('{{ resourceKebabCase }}', Str::kebab($resourceLastName), $stub);

        File::ensureDirectoryExists($basePath);

        $createresource = true;

        if (File::exists($path)) {
            $confirmation = (bool) $this->confirm('Parece que <comment>' . $resourceName . '</comment> já existe. Você gostaria de sobrescrever?');

            if ($confirmation === false) {
                $createresource = false;
            }
        }

        if ($createresource && is_string($stub)) {
            File::put($path, $stub);
             $path = Str::lower($resourceLastName);
             $path = Str::plural($path);
            $this->info("\n⚡ <comment>" . $filename . '</comment> foi criado com sucesso em [<comment>App/' . $savedAt . '</comment>].');
            $this->info("\n⚡ou pode ser acessada via: <comment>http://" . request()->getHost() . "/api/" . $path . "</comment>\n");
        }
    }
}