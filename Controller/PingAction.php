<?php

namespace Simonetti\PingBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Lock\Lock;

class PingAction
{
    protected Lock $lock;

    public function __construct(Lock $lock)
    {
        $this->lock = $lock;
    }

    public function __invoke(): Response
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
