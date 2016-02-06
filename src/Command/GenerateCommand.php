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
    private $inheritanceFinder;
    /**
     * @var ClassSelector
     */
    private $classSelector;

    /**
     * GenerateCommand constructor.
     * @param DependencyResolverInterface $resolver
     * @param InheritanceFinderInterface $inheritanceFinder
     */
    public function __construct(DependencyResolverInterface $resolver, InheritanceFinderInterface $inheritanceFinder, ClassSelector $classSelector) {
        $this->resolver          = $resolver;
        $this->inheritanceFinder = $inheritanceFinder;
        $this->classSelector     = $classSelector;
    }

    /**
     * @param $applicationRoot
     */
    public function generate($applicationRoot) {
        $classes = $this->classSelector->getClasses($applicationRoot);

        $factory = new BuilderFactory();

        foreach ($classes['included'] as $class) {
            try {
                $class = $this->inheritanceFinder->findClass($class);
                /* @var $object \Synga\PhpStormMeta\PhpStormMetaExtensionInterface */
                $object = $this->resolver->resolve($class->getFullQualifiedNamespace());
                $object->execute($factory);
                $this->output->info($class->getFullQualifiedNamespace() . 'added to .phpstorm.meta.php');
            } catch (\Exception $e) {
                $this->output->warn('Class ' . $class->getFullQualifiedNamespace() . ' could not be initiated.');
            }
        }

        $builder = $factory->getAndRemoveBuilder();

        file_put_contents($applicationRoot . '/.phpstorm.meta.php', $builder->build());

        $this->output->info('.phpstorm.meta.php file written in application root.');
    }
}