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

class LockCommand extends Command
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
