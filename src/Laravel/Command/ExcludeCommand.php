<?php
/**
 * Synga Inheritance Finder
 * @author      Roy Pouls
 * @copytright  2016 Roy Pouls / Synga (http://www.synga.nl)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/synga-nl/inheritance-finder
 */

namespace Synga\PhpStormMeta\Laravel\Command;


use Illuminate\Console\Command;
use Synga\ConsoleAbstraction\LaravelConsoleInteraction;
use Synga\InheritanceFinder\InheritanceFinderInterface;
use Synga\PhpStormMeta\Command\ClassSelector;

class ExcludeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phpstorm-meta:exclude';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets all phpstorm-meta classes and gives you the option to exclude them';

    /**
     * Execute the console command.
     *
     * @param InheritanceFinderInterface $inheritanceFinder
     * @return mixed
     */
    public function handle(InheritanceFinderInterface $inheritanceFinder) {
        $includeCommand = new ClassSelector($inheritanceFinder);

        $laravelConsoleInteraction = new LaravelConsoleInteraction();
        $laravelConsoleInteraction->setCommand($this);

        $includeCommand->setOutput($laravelConsoleInteraction);

        $includeCommand->excludeCommand(base_path());
    }
}