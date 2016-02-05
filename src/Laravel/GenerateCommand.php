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

class GenerateCommand extends Command
{
    use InheritanceFinderCreaterTrait;

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
     * @return mixed
     */
    public function handle() {
        $inheritanceFinder = $this->getInheritanceFinder();

        $generateCommand = new \Synga\PhpStormMeta\Command\GenerateCommand(new Resolver($this->getLaravel()), $inheritanceFinder);
        $generateCommand->generate(base_path());
    }
}