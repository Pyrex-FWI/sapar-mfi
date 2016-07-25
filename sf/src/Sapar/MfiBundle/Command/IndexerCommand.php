<?php

namespace Sapar\MfiBundle\Command;

use Sapar\Mfi\Filter\ArtistFilter;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class IndexerCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sapar-mfi:indexer')
            ->addOption('artist', '--a', InputOption::VALUE_OPTIONAL)
            ->setDescription('Hello PhpStorm');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mfi = $this->getContainer()->get('sapar_mfi.finder');
        if ($input->getOption('artist')) {
            $artistFilter = new ArtistFilter($input->getOption('artist'));
            $mfi->addMediaFilter($artistFilter);
        }
        foreach ($mfi->in("/Volumes/Extend")->getIterator() as $file) {
            $output->writeln($file."");
        }


    }
}
