<?php

namespace Simonetti\PingBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Lock\Lock;

#[AsCommand(name: 'ping:lock', description: 'Lock the Ping')]
class LockCommand extends Command
{
    public function __construct(protected Lock $lock)
    {
        parent::__construct();

        $this->lock = $lock;
    }

    protected function configure(): void
    {
        $this
            ->addOption(
                'release',
                'r',
                InputOption::VALUE_NONE,
                'If set, the lock will be released',
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($input->getOption('release')) {
            $this->lock->release();
            $output->writeln('The lock was released.');
            return 0;
        }

        $this->lock->acquire();
        $output->writeln('The app is locked.');
        return 0;
    }
}
