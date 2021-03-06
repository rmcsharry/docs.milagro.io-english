<?php

namespace Couscous\Application\Cli;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Clear all file generated by Couscous.
 *
 * Useful if there's any kind of problem with Couscous generation.
 *
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class ClearCommand extends Command
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('clear')
            ->setDescription('Clear all file generated by Couscous');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = getcwd().'/.couscous';

        if (file_exists($dir)) {
            $output->writeln("<comment>Deleting folder $dir</comment>");
            $this->filesystem->remove($dir);
        } else {
            $output->writeln('<comment>Nothing to clear</comment>');
        }
    }
}
