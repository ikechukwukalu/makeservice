<?php

namespace Ikechukwukalu\Makeservice\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:repository')]
class MakeRepositoryCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     *
     * @deprecated
     */
    protected static $defaultName = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Respository';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $model = $this->option('model');

        if ($this->option('contract')) {
            $interface = $model . "RepositoryInterface";
            $this->call('make:interface', ['name' => $interface, '--model' => $model]);
        } else {
            $interface = $this->option('interface');
        }

        if (! Str::startsWith($model, [
            $this->laravel->getNamespace(),
            'Illuminate',
            '\\',
        ])) {
            $model = $this->laravel->getNamespace().'Models\\'.str_replace('/', '\\', $model);
        }

        if (! Str::startsWith($interface, [
            $this->laravel->getNamespace(),
            'Illuminate',
            '\\',
        ])) {
            $interface = $this->laravel->getNamespace().'Contracts\\'.str_replace('/', '\\', $interface);
        }

        $stub = str_replace(
            ['DummyModel', '{{ model }}'], class_basename($model), parent::buildClass($name)
        );

        $stub = str_replace(
            ['DummyFullModel', '{{ modelNamespace }}'], trim($model, '\\'), $stub
        );

        $stub = str_replace(
            ['DummyInterface', '{{ interface }}'], class_basename($interface), $stub
        );

        return str_replace(
            ['DummyFullInterface', '{{ interfaceNamespace }}'], trim($interface, '\\'), $stub
        );
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($rawName) ||
               $this->files->exists($this->getPath($this->qualifyClass($rawName)));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/repository.stub';
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
                        ? $customPath
                        : __DIR__.$stub;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Repositories';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['contract', 'c', InputOption::VALUE_NONE, 'Create an interface class for this repository'],
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the repository already exists'],
            ['interface', 'i', InputOption::VALUE_OPTIONAL, 'Create an interface namespace for this repository'],
            ['model', 'm', InputOption::VALUE_REQUIRED, 'Create a model namespace for this repository'],
        ];
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if ($this->isReservedName($this->getNameInput())) {
            $this->components->error('The name "'.$this->getNameInput().'" is reserved by PHP.');
            return false;
        }

        if (!$this->areOptionsPresent()) {
            return false;
        }

        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getPath($name);

        if ((! $this->hasOption('force') ||
             ! $this->option('force')) &&
             $this->alreadyExists($this->getNameInput())) {
            $this->components->error($this->type.' already exists.');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->sortImports($this->buildClass($name)));

        $info = $this->type;

        if (in_array(CreatesMatchingTest::class, class_uses_recursive($this))) {
            if ($this->handleTestCreation($path)) {
                $info .= ' and test';
            }
        }

        $this->components->info(sprintf('%s [%s] created successfully.', $info, $path));
    }

    private function areOptionsPresent():bool
    {
        if (!$this->option('model')) {
            if (!($this->option('contract') || $this->option('interface'))) {
                $this->components->error('Expected options "model" and "contract or interface"!');
                return false;
            }

            $this->components->error('Expected option "model"!');
            return false;
        }

        if (!($this->option('contract') || $this->option('interface'))) {
            $this->components->error('Expected option "interface or contract"!');
            return false;
        }

        return true;
    }
}
