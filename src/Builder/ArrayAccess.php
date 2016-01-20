<?php
namespace Synga\PhpStormMeta\Builder;

use Synga\PhpStormMeta\Builder\Types\Class_;

class ArrayAccess extends BuilderTypeAbstract implements BuilderTypeInterface
{
    use Class_;

    public function getCode() {
        return $this->getValueCode('new \\' . $this->class);
    }
}