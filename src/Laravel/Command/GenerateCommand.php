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
use Synga\PhpStormMeta\Laravel\Resolver;

class GenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phpstorm-meta:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets all phpstorm-meta classes and generates a phpstorm-meta file';

    /**
     * Execute the console command.
     *
     * @param InheritanceFinderInterface $inheritanceFinder
     * @return mixed
     */
    public function handle(InheritanceFinderInterface $inheritanceFinder) {
        $generateCommand = new \Synga\PhpStormMeta\Command\GenerateCommand(new Resolver($this->getLaravel()), $inheritanceFinder, new ClassSelector($inheritanceFinder));

        $laravelConsoleInteraction = new LaravelConsoleInteraction();
        $laravelConsoleInteraction->setCommand($this);

        $generateCommand->setOutput($laravelConsoleInteraction);

        $generateCommand->generate(base_path());
    }
}