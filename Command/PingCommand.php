<?php
namespace Simonetti\PingBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{
    InputInterface, InputOption
};
use Symfony\Component\Console\Output\{
    OutputInterface
};
use Symfony\Component\Lock\Key;
use Symfony\Component\Lock\Lock;
use Symfony\Component\Lock\Store\FlockStore;

class PingCommand extends Command
{
    /**
     * @var Lock
     */
    protected $lock;

    /**
     * LockCommand constructor.
     * @param Lock $lock
     */
    public function __construct(Lock $lock)
    {
        parent::__construct();
        $this->lock = $lock;
    }

    protected function configure()
    {
        $this
            ->setName('ping')
            ->setDescription('Ping')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->lock->isAcquired() ? 'The app is locked.' : 'PONG!');
    }
}