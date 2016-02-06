<?php
/**
 * Synga Inheritance Finder
 * @author      Roy Pouls
 * @copytright  2016 Roy Pouls / Synga (http://www.synga.nl)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/synga-nl/inheritance-finder
 */

namespace Synga\PhpStormMeta\Laravel;


use Synga\InheritanceFinder\InheritanceFinderFactory;

trait InheritanceFinderCreaterTrait
{
    /**
     * Gets an inheritance finder for the Laravel Framework.
     *
     * @return mixed
     */
    protected function getInheritanceFinder(){
        if(!file_exists(storage_path('class_cache'))){
            mkdir(storage_path('class_cache'));
        }

        $config = new \Synga\InheritanceFinder\File\FileConfig();

        $config->setApplicationRoot(base_path());
        $config->setCacheDirectory(storage_path('class_cache'));

        return (new InheritanceFinderFactory())->getInheritanceFinder($config);
    }
}