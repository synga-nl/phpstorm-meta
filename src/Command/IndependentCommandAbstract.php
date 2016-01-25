<?php
namespace Synga\PhpStormMeta\Command;

use Synga\ConsoleAbstraction\ConsoleInteractionInterface;

class IndependentCommandAbstract
{
    /**
     * @var ConsoleInteractionInterface
     */
    protected $output;

    public function setOutput(ConsoleInteractionInterface $consoleInteraction) {
        $this->output = $consoleInteraction;
    }
}