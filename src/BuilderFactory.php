<?php
namespace Synga\PhpStormMeta;

use Synga\PhpStormMeta\Builder\ArrayAccess;
use Synga\PhpStormMeta\Builder\ClassMethod;
use Synga\PhpStormMeta\Builder\GlobalFunction;
use Synga\PhpStormMeta\Builder\StaticCall;

/**
 * Class BuilderFactory
 * @package Synga\PhpStormMeta
 */
class BuilderFactory
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * BuilderFactory constructor.
     * @param Builder|null $builder
     */
    public function __construct(Builder $builder = null) {
        if ($builder == null) {
            $this->builder = new Builder();
        } else {
            $this->builder = $builder;
        }
    }

    /**
     * @return StaticCall
     */
    public function addStaticCall() {
        $staticCall = new StaticCall();
        $this->builder->addContent($staticCall);

        return $staticCall;
    }

    /**
     * @return ArrayAccess
     */
    public function addArrayAccess() {
        $arrayAccess = new ArrayAccess();
        $this->builder->addContent($arrayAccess);

        return $arrayAccess;
    }

    /**
     * @return ClassMethod
     */
    public function addClassMethod() {
        $classMethod = new ClassMethod();
        $this->builder->addContent($classMethod);

        return $classMethod;
    }

    /**
     * @return GlobalFunction
     */
    public function addGlobalFunction() {
        $globalFunction = new GlobalFunction();
        $this->builder->addContent($globalFunction);

        return $globalFunction;
    }

    /**
     * @param Builder|null $builder
     * @return Builder
     */
    public function getAndRemoveBuilder(Builder $builder = null){
        $builder = $this->builder;
        if($builder === null) {
            $this->builder = new Builder();
        } else {
            $this->builder = $builder;
        }

        return $builder;
    }
}