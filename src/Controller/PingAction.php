<?php

namespace Simonetti\Bundle\PingBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Lock\Lock;

/**
 * Class PingAction
 * @package Simonetti\Bundle\PingBundle\Controller
 */
class PingAction
{
    /**
     * @var Lock
     */
    protected $lock;

    /**
     * PingAction constructor.
     * @param Lock $lock
     */
    public function __construct(Lock $lock)
    {
        $this->lock = $lock;
    }

    public function __invoke()
    {
        $status = Response::HTTP_OK;
        $content = 'PONG!';
        if ($this->lock->isAcquired()) {
            $status = Response::HTTP_LOCKED;
            $content = 'Locked';
        }

        return new Response($content, $status);
    }


}