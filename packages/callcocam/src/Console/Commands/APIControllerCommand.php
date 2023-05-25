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

class APIControllerCommand extends MakeCommad
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api-controller {name} {--template= : nome para o controller stub}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um controller perssonalizado';

    


    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';


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

        $controllerName       = sprintf("%s%s", $name, $this->type);

        $controllerName = str_replace(['.', '\\'], '/', (string) $controllerName);

        $stub = $this->getStubs('api');

        $modelName      = '';
        $modelLastName  = '';
        $modelName = $this->ask('Insira o caminho do seu modelo (E.g., <comment>App\Models\User ou User</comment>)');
        if (!is_string($modelName)) {
            throw new \Exception('Could not parse table name');
        }
        if (!Str::contains($modelName, "\\")) {
            $modelName = sprintf("App\\Models\\%s", $modelName);
        }
        if (!Str::contains($modelName, "\\")) {
            $resourceName = sprintf("App\\Resources\\%s", $modelName);
        }
        else{
            $resourceName = Str::replace("Models", "Resources", $modelName);
        }

        $modelNameArr = [];

        preg_match('/(.*)(\/|\.|\\\\)(.*)/', $controllerName, $matches);

        if (!is_array($matches)) {
            throw new Exception('Could not parse model name');
        }

        $modelNameArr  = explode('\\', $modelName);
        $modelLastName = Arr::last($modelNameArr);

        if (empty($modelName)) {
            $this->error('Could not create, Model path is missing');
        }


        $this->modelExist($modelName, $modelLastName);

        $controllerName   = $controllerName;
        $subFolder       = '';

        if (!empty($matches)) {
            $controllerName = end($matches);
            array_splice($matches, 2);
            $subFolder = '\\' . str_replace(['.', '/', '\\\\'], '\\', end($matches));
        }
        if (!is_string($controllerName)) {
            throw new \Exception('Could not parse controller name');
        }

        if (!is_string($subFolder)) {
            throw new \Exception('Could not parse subfolder name');
        }

        $controller_name = Str::of($controllerName)
            ->lower()
            ->kebab()
            ->replace('/', '.')
            ->replace('\\', '.')
            ->replace('table', '-table')
            ->prepend('<controller:')
            ->append('/>');


        $appPath  = 'App\\';
        $controllerPath  = 'Http/Controllers/API/';

        $path          = app_path($controllerPath . $controllerName . '.php');

        $filename  = Str::of($path)->basename();

        $basePath  = Str::of($path)->replace($filename, '');

        $savedAt   = $controllerPath . $basePath->after($controllerPath);

        $Namespace = $appPath . str_replace(['.', '/', '\\\\'], '\\', $savedAt);

        $Namespace = Str::beforeLast($Namespace, '\\');

        $stub = str_replace('{{ subFolder }}', $subFolder, $stub);
        $stub = str_replace('{{ controllerName }}', $controllerName, $stub);
        $stub = str_replace('{{ modelName }}', $modelName, $stub);
        $stub = str_replace('{{ resourceName }}', $resourceName, $stub);
        $stub = str_replace('{{ controllerNamespace }}', $Namespace, $stub);
        $stub = str_replace('{{ modelLastName }}', $modelLastName, $stub);
        $stub = str_replace('{{ modelLowerCase }}', Str::lower($modelLastName), $stub);
        $stub = str_replace('{{ modelKebabCase }}', Str::kebab($modelLastName), $stub);

        File::ensureDirectoryExists($basePath);

        $createcontroller = true;

        if (File::exists($path)) {
            $confirmation = (bool) $this->confirm('Parece que <comment>' . $controllerName . '</comment> já existe. Você gostaria de sobrescrever?');

            if ($confirmation === false) {
                $createcontroller = false;
            }
        }

        if ($createcontroller && is_string($stub)) {
            File::put($path, $stub);
             $path = Str::lower($modelLastName);
             $path = Str::plural($path);
            $this->info("\n⚡ <comment>" . $filename . '</comment> foi criado com sucesso em [<comment>App/' . $savedAt . '</comment>].');
            $this->info("\n⚡ou pode ser acessada via: <comment>http://" . request()->getHost() . "/api/" . $path . "</comment>\n");
        }
    }
}