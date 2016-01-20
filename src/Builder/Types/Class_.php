<?php
namespace Synga\PhpStormMeta\Builder\Types;

/**
 * Class Class_
 * @package Synga\PhpStormMeta\Builder\Types
 */
trait Class_
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @return string
     */
    public function getClass() {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class) {
        $this->class = $class;

        return $this;
    }
}