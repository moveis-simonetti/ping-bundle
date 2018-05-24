<?php
namespace Simonetti\PingBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\{
    InputInterface, InputOption
};
use Symfony\Component\Console\Output\{
    OutputInterface
};

class LockCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ping:lock')
            ->setDescription('Lock the Ping')
            ->addOption(
                'release',
                'r',
                InputOption::VALUE_NONE,
                'If set, the lock will be released'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $lock = $this->getContainer()->get('simonetti.bundle.ping.lock');

        if ($input->getOption('release')) {
            $lock->release();
            $output->writeln('The lock was released.');
            return;
        }

        $lock->acquire();
        $output->writeln('The app is locked.');
    }
}