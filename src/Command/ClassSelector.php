<?php
namespace Synga\PhpStormMeta\Command;

use Synga\InheritanceFinder\InheritanceFinderInterface;

class ClassSelector extends IndependentCommandAbstract
{
    /**
     * @var InheritanceFinderInterface
     */
    private $inheritanceFinder;

    public function __construct(InheritanceFinderInterface $inheritanceFinderFactory) {
        $this->inheritanceFinder = $inheritanceFinderFactory;
    }

    public function excludeCommand($applicationRoot) {
        $classes = $this->getClasses($applicationRoot);

        if (!empty($classes['included'])) {
            $toBeExcluded = $this->output->choice('Which class do you want to exclude? You can give multiple values in a comma separated list', array_values($classes['included']), null, null, true);
            $this->excludeClasses($applicationRoot, $classes['excluded'], $toBeExcluded);
        } else {
            $this->output->info('There are no classes to exclude');
        }
    }

    public function includeCommand($applicationRoot) {
        $classes = $this->getClasses($applicationRoot);

        if (!empty($classes['excluded'])) {
            $toBeExcluded = $this->output->choice('Which class do you want to include? You can give multiple values in a comma separated list', array_values($classes['excluded']), null, null, true);
            $this->includeClasses($applicationRoot, $classes['excluded'], $toBeExcluded);
        } else {
            $this->output->info('There are no classes to include');
        }
    }

    protected function excludeClasses($applicationRoot, $classes, $toBeExcluded) {
        $this->writeToCacheFile($applicationRoot, array_unique(array_merge($classes, $toBeExcluded)));
    }

    protected function includeClasses($applicationRoot, $classes, $toBeIncluded) {
        $this->writeToCacheFile($applicationRoot, array_unique(array_diff($classes, $toBeIncluded)));
    }

    public function getClasses($applicationRoot) {
        $result = ['excluded' => [], 'included' => [], 'all' => []];

        $classes = $this->inheritanceFinder->findImplements('Synga\PhpStormMeta\PhpStormMetaExtensionInterface');
        if (is_array($classes)) {
            foreach ($classes as $class) {
                $result['all'][] = $class->getFullQualifiedNamespace();
            }
        }

        $cachePath = $applicationRoot . '/.phpstorm.meta.cache';
        if (file_exists($cachePath)) {
            $result['excluded'] = unserialize(file_get_contents($cachePath));
        }

        $result['included'] = array_diff($result['all'], $result['excluded']);

        return $result;
    }

    protected function writeToCacheFile($applicationRoot, $data) {
        $file = $applicationRoot . '/.phpstorm.meta.cache';
        file_put_contents($file, serialize($data));

    }
}