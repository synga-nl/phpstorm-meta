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
            case 'array':
                return '\stdClass';
            default:
                return $type;
        }
    }

    protected function getValueCode($prefix) {
        $string = PHP_EOL;
        $string .= $this->getIndentation(2) . $prefix;
        $string .= " => [" . PHP_EOL;
        $string .= $this->getIndentation(3) . $this->getIgnoreCode();

        foreach ($this->getContent() as $key => $content) {
            $string .= $this->getIndentation(3) . "'" . $key . "' instanceof " . $this->convertType($content) . ',' . PHP_EOL;
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