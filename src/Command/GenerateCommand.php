<?php
namespace Synga\PhpStormMeta\Command;

use Synga\InheritanceFinder\InheritanceFinderInterface;
use Synga\PhpStormMeta\BuilderFactory;
use Synga\PhpStormMeta\DependencyResolverInterface;

/**
 * Class GenerateCommand
 * @package Synga\PhpStormMeta\Command
 */
class GenerateCommand extends IndependentCommandAbstract
{
    /**
     * @var DependencyResolverInterface
     */
    private $resolver;
    /**
     * @var InheritanceFinderInterface
     */
    private $inheritanceFinderFactory;

    /**
     * GenerateCommand constructor.
     * @param DependencyResolverInterface $resolver
     * @param InheritanceFinderInterface $inheritanceFinderFactory
     */
    public function __construct(DependencyResolverInterface $resolver, InheritanceFinderInterface $inheritanceFinderFactory) {
        $this->resolver = $resolver;
        $this->inheritanceFinderFactory = $inheritanceFinderFactory;
    }

    /**
     * @param $applicationRoot
     */
    public function generate($applicationRoot) {
        $classes       = $this->inheritanceFinderFactory->findImplements('\Synga\PhpStormMeta\PhpStormMetaExtensionInterface', $applicationRoot);

        $factory = new BuilderFactory();

        foreach ($classes as $class) {
            try {
                /* @var $object \Synga\PhpStormMeta\PhpStormMetaExtensionInterface */
                $object = $this->resolver->resolve($class->getFullQualifiedNamespace());
                $object->execute($factory);
            } catch (\Exception $e) {
                echo 'Class '. $class->getFullQualifiedNamespace() . ' could not be initiated.';
            }
        }

        $builder = $factory->getAndRemoveBuilder();

        file_put_contents($applicationRoot . '/.phpstorm.meta.php', $builder->build());
    }
}