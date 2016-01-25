<?php
namespace Synga\PhpStormMeta\Laravel;

use Illuminate\Contracts\Container\Container;
use Synga\PhpStormMeta\DependencyResolverInterface;

/**
 * Class Resolver
 * @package Synga\PhpStormMeta\Laravel
 */
class Resolver implements DependencyResolverInterface
{
    /**
     * Container to create a class with its dependencies
     *
     * @var Container
     */
    private $container;

    /**
     * Resolver constructor.
     * @param Container $container
     */
    public function __construct(Container $container) {
        $this->container = $container;
    }

    /**
     * Resolves the given class and add passes the given arguments
     *
     * @param $class
     * @param array $parameters
     * @return mixed
     */
    public function resolve($class, $parameters = []) {
        return $this->container->make($class, $parameters);
    }
}