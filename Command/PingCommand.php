<?php

namespace Simonetti\PingBundle\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Lock\Lock;

#[AsCommand(name: 'ping', description: 'Ping')]
class PingCommand extends Command
{
    protected Lock $lock;

    public function __construct(Lock $lock)
    {
        parent::__construct();

        $this->lock = $lock;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln($this->lock->isAcquired() ? 'The app is locked.' : 'PONG!');
        return 0;
    }
}
