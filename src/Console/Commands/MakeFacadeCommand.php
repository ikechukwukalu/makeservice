<?php

namespace Ikechukwukalu\Makeservice\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:facade')]
class MakeFacadeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:facade';

    /**
     * The name of the console command.
     *
     * This name is used to identify the command during lazy loading.
     *
     * @var string|null
     *
     * @deprecated
     */
    protected static $defaultName = 'make:facade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new facade class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Facade';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $contract = $this->option('contract');
        $accessor = explode('\\', strtolower($name));
        $accessor = array_pop($accessor);

        if (! Str::startsWith($contract, [
            $this->laravel->getNamespace(),
            'Illuminate',
            '\\',
        ])) {
            $contract = $this->laravel->getNamespace().'Contracts\\'.str_replace('/', '\\', $contract);
        }

        $stub = str_replace(
            ['DummyContract', '{{ contract }}'], class_basename($contract), parent::buildClass($name)
        );

        $stub = str_replace(
            ['DummyFullAccessor', '{{ accessor }}'], $accessor, $stub
        );

        return str_replace(
            ['DummyFullContract', '{{ contractNamespace }}'], trim($contract, '\\'), $stub
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
        if ($this->option('contract')) {
            return __DIR__.'/stubs/facade.stub';
        }

        return __DIR__.'/stubs/facade-duck.stub';
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
        return $rootNamespace.'\Facades';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the facade already exists'],
            ['contract', 'c', InputOption::VALUE_OPTIONAL, 'Create a contract namespace for this facade'],
        ];
    }
}
