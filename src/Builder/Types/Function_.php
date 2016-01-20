<?php
namespace Synga\PhpStormMeta\Builder\Types;

/**
 * Class Function_
 * @package Synga\PhpStormMeta\Builder\Types
 */
trait Function_
{
    /**
     * @var string
     */
    protected $function;

    /**
     * @return string
     */
    public function getFunction() {
        return $this->function;
    }

    /**
     * @param string $function
     * @return $this
     */
    public function setFunction($function) {
        $this->function = $function;

        return $this;
    }
}