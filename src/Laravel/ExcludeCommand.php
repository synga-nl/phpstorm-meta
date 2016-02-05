<?php
/**
 * Synga Inheritance Finder
 * @author      Roy Pouls
 * @copytright  2016 Roy Pouls / Synga (http://www.synga.nl)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 * @link        https://github.com/synga-nl/inheritance-finder
 */

namespace Synga\PhpStormMeta\Laravel;


use Illuminate\Console\Command;
use Synga\ConsoleAbstraction\LaravelConsoleInteraction;
use Synga\PhpStormMeta\Command\ClassSelector;

class ExcludeCommand extends Command
{
    use InheritanceFinderCreaterTrait;

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
     * @return mixed
     */
    public function handle() {
        $inheritanceFinder = $this->getInheritanceFinder();

        $includeCommand = new ClassSelector($inheritanceFinder);

        $laravelConsoleInteraction = new LaravelConsoleInteraction();
        $laravelConsoleInteraction->setCommand($this);

        $includeCommand->setOutput($laravelConsoleInteraction);

        $includeCommand->includeCommand(base_path());
    }
}