<?php
namespace Simonetti\PingBundle\Factory;

use Symfony\Component\Lock\Factory;
use Symfony\Component\Lock\StoreInterface;

/**
 * Class LockFactory
 * @package Simonetti\PingBundle\Factory
 */
class LockFactory
{

    /**
     * @var StoreInterface
     */
    protected $store;

    public function factory(string $name)
    {
        return (new Factory($this->store))->createLock($name);
    }
}