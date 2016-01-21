<?php
namespace Synga\PhpStormMeta;

interface DependencyResolverInterface
{
    public function resolve($class, $parameters = []);
}