<?php
namespace Synga\PhpStormMeta\Builder;

use Synga\PhpStormMeta\Builder\Types\Class_;
use Synga\PhpStormMeta\Builder\Types\Method_;

class StaticCall extends BuilderTypeAbstract implements BuilderTypeInterface
{
    use Class_, Method_;

    public function getCode() {
        $string = PHP_EOL;
        $string .= $this->getIndentation(2) . '\\' . $this->class . '::' . $this->method . "('') => [" . PHP_EOL;

        $string .= $this->getIndentation(3) . $this->getIgnoreCode();

        foreach ($this->getContent() as $key => $content) {
            $string .= $this->getIndentation(3) . "'" . $key . "' instanceof " . $this->convertType($content) . ',' . PHP_EOL;
        }

        $string .= $this->getIndentation(2) . ']';

        return $string;
    }
}