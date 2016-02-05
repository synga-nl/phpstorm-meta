<?php
namespace Synga\PhpStormMeta\Laravel;

use Illuminate\Support\ServiceProvider;

class PhpStormMetaServiceProvider extends ServiceProvider
{
    /**
     * Registers the commands
     */
    public function register() {
        $this->commands([
            'Synga\PhpStormMeta\Laravel\ExcludeCommand',
            'Synga\PhpStormMeta\Laravel\IncludeCommand',
            'Synga\PhpStormMeta\Laravel\GenerateCommand',
        ]);
    }
}