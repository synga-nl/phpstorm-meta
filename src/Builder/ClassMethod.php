<?php
namespace Synga\PhpStormMeta\Builder;

use Synga\PhpStormMeta\Builder\Types\Class_;
use Synga\PhpStormMeta\Builder\Types\Method_;

class ClassMethod extends BuilderTypeAbstract implements BuilderTypeInterface
{
    use Class_, Method_;

    public function getCode() {
        return $this->getValueCode('\\' . $this->class . '::' . $this->method . "('')");
    }
}