<?php
namespace Synga\PhpStormMeta;

interface PhpStormMetaExtensionInterface
{
    public function execute(BuilderFactory $factory);
}