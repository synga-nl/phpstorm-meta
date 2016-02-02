<?php
namespace Synga\PhpStormMeta\Command;

use Synga\InheritanceFinder\InheritanceFinderInterface;

class ExcludeCommand extends IndependentCommandAbstract
{
    /**
     * @var InheritanceFinderInterface
     */
    private $inheritanceFinder;

    public function __construct(InheritanceFinderInterface $inheritanceFinder) {
        $this->inheritanceFinder = $inheritanceFinder;
    }

    public function exclude($applicationRoot){
        $namespaces = [];
        $excludeArray = [];
        $classes = $this->inheritanceFinder->findImplements('\Synga\PhpStormMeta\PhpStormMetaExtensionInterface');
        if(is_array($classes)){
            $namespaces = [];

            foreach($classes as $class){
                $namespaces[] = $class->getFullQualifiedNamespace();
            }
        }

        $cachePath = $applicationRoot . '/.phpstorm.meta.cache';
        if(file_exists($cachePath)){
            $excludeArray = unserialize(file_get_contents($cachePath));
        }

        $activeClasses = array_diff($namespaces, $excludeArray);

        $this->output->choice('Which class do you want to exclude?', $activeClasses, null, null, true);
    }
}