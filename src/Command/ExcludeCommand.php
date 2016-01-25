<?php
namespace Synga\PhpStormMeta\Command;

use Synga\InheritanceFinder\InheritanceFinderInterface;

class ExcludeCommand extends IndependentCommandAbstract
{
    /**
     * @var InheritanceFinderInterface
     */
    private $inheritanceFinderFactory;

    public function __construct(InheritanceFinderInterface $inheritanceFinderFactory) {
        $this->inheritanceFinderFactory = $inheritanceFinderFactory;
    }

    public function exclude($applicationRoot){
        $namespaces = [];
        $excludeArray = [];
        $classes = $this->inheritanceFinderFactory->findImplements('\Synga\PhpStormMeta\PhpStormMetaExtensionInterface', $applicationRoot);
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