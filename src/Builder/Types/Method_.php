<?php
namespace Synga\PhpStormMeta\Builder\Types;

/**
 * Class Method_
 * @package Synga\PhpStormMeta\Builder\Types
 */
trait Method_
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod($method) {
        $this->method = $method;

        return $this;
    }
}