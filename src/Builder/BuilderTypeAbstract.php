<?php
namespace Synga\PhpStormMeta\Builder;

/**
 * Class BuilderTypeAbstract
 * @package Synga\PhpStormMeta\Builder
 */
abstract class BuilderTypeAbstract
{
    /**
     * @var array
     */
    protected $content = [];

    /**
     * @var bool
     */
    protected $ignoreEmpty = false;

    /**
     * @return array
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param array $content
     * @return $this
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * @param $allContent
     * @return $this
     */
    public function setAllContent($allContent) {
        $this->content = $allContent;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIgnoreEmpty() {
        return $this->ignoreEmpty;
    }

    /**
     * @param boolean $ignoreEmpty
     * @return $this
     */
    public function setIgnoreEmpty($ignoreEmpty) {
        $this->ignoreEmpty = $ignoreEmpty;

        return $this;
    }

    protected function convertType($type) {
        switch ($type) {
            case 'int':
            case 'string':
            case 'float':
            case 'bool':
                return $type;
            case 'array':
                return '\stdClass';
            default:
                return '\\' . ltrim($type, '\\');
        }
    }

    protected function getValueCode($prefix) {
        $string = PHP_EOL;
        $string .= $this->getIndentation(2) . $prefix;
        $string .= " => [" . PHP_EOL;
        $string .= $this->getIndentation(3) . $this->getIgnoreCode();

        $first = true;
        foreach ($this->getContent() as $key => $content) {
            if($this->ignoreEmpty === false && $first === true) {
                $string .= $this->getIndentation(0);
            } else {
                $string .= $this->getIndentation(3);
            }
            $string .= "'" . $key . "' instanceof " . $this->convertType($content) . ',' . PHP_EOL;
            $first = false;
        }

        $string .= $this->getIndentation(2) . ']';

        return $string;
    }

    protected function getIgnoreCode() {
        if ($this->ignoreEmpty === true) {
            return "'' == '@'," . PHP_EOL;
        }

        return '';
    }

    protected function getIndentation($count, $char = '    ') {
        return str_repeat($char, $count);
    }
}