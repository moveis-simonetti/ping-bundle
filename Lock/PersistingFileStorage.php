<?php
namespace Simonetti\PingBundle\Lock;

use Symfony\Component\Lock\BlockingStoreInterface;
use Symfony\Component\Lock\PersistingStoreInterface;

/**
 * Class FileStorage
 * @package Simonetti\PingBundle\Lock
 */
class PersistingFileStorage extends AbstractFileStorage implements PersistingStoreInterface, BlockingStoreInterface
{
}
