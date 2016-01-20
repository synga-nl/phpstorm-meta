<?php
namespace Synga\PhpStormMeta;

use Synga\PhpStormMeta\Builder\BuilderTypeInterface;

class Builder
{
    /**
     * @var BuilderTypeInterface[]
     */
    protected $content = [];

    public function addContent(BuilderTypeInterface $content) {
        $this->content[] = $content;
    }

    public function build() {
        $code = $this->getFileHeader();
        foreach ($this->content as $content) {
            $code .= $content->getCode() . ',';
        }
        $code .= $this->getFileFooter();

        return $code;
    }

    protected function getFileHeader() {
        return '<?php
/**
 * PhpStorm Meta file, to provide autocomplete information for PhpStorm
 * Generated on ' . date('Y-m-d') . '.
 *
 * @author Roy Pouls <github@synga.nl>
 */
namespace PHPSTORM_META {
    $STATIC_METHOD_TYPES = [';
    }

    protected function getFileFooter() {
        return '
    ];
}';
    }
}