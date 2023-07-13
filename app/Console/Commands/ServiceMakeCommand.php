<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class ServiceMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service';

    protected $type = 'Service';

    protected static $defaultName = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建Service类文件';

    protected function alreadyExists($rawName): bool
    {
        return class_exists($rawName) ||
            $this->files->exists($this->getPath($this->qualifyClass($rawName)));
    }

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
