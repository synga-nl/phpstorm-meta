<?php
namespace Synga\PhpStormMeta\Laravel;

use Illuminate\Support\ServiceProvider;
use Synga\InheritanceFinder\InheritanceFinderFactory;

class PhpStormMetaServiceProvider extends ServiceProvider
{
    /**
     * Registers the commands
     */
    public function register() {
        $this->commands([
            'Synga\PhpStormMeta\Laravel\Command\ExcludeCommand',
            'Synga\PhpStormMeta\Laravel\Command\IncludeCommand',
            'Synga\PhpStormMeta\Laravel\Command\GenerateCommand',
        ]);

        $this->app->singleton('Synga\InheritanceFinder\InheritanceFinderInterface', function(){
            if(!file_exists(storage_path('class_cache'))){
                mkdir(storage_path('class_cache'));
            }

            $config = new \Synga\InheritanceFinder\File\FileConfig();

            $config->setApplicationRoot(base_path());
            $config->setCacheDirectory(storage_path('class_cache'));

            return InheritanceFinderFactory::getInheritanceFinder($config);
        });
    }
}