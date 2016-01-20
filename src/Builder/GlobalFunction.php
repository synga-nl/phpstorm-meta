<?php
namespace Synga\PhpStormMeta\Builder;

use Synga\PhpStormMeta\Builder\Types\Function_;

class GlobalFunction extends BuilderTypeAbstract implements BuilderTypeInterface
{
    use Function_;

    public function getCode() {
        return $this->getValueCode($this->function . "('')");
    }
}