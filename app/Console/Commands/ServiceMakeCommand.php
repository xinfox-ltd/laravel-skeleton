<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'make:service')]
class ServiceMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    protected function resolveStubPath(string $stubPath): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stubPath, '/')))
            ? $customPath
            : __DIR__ . $stubPath;
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Services';
    }

    protected function getStub(): string
    {
        return $this->resolveStubPath('/stubs/service.stub');
    }
}
