<?php
namespace Synga\PhpStormMeta\Command;

use Synga\InheritanceFinder\InheritanceFinderFactory;

class GenerateCommand
{
    public function generate($applicationRoot, $inheritanceFinderCacheLocation) {
        $phpFileFinder = InheritanceFinderFactory::getInheritanceFinder($inheritanceFinderCacheLocation);
        $classes       = $phpFileFinder->findImplements('\Synga\PhpStormMeta\PhpStormMetaExtensionInterface', $applicationRoot);
    }
}