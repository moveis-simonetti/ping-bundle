<?php
namespace Simonetti\PingBundle\Lock;

use Symfony\Component\Lock\Key;

/**
 * Class FileStorage
 * @package Simonetti\PingBundle\Lock
 */
class AbstractFileStorage
{
    /**
     * @var string
     */
    protected $path;

    /**
     * FileStorage constructor.
     * @param string $path
     */
    public function __construct(string $path = null)
    {
        if (! $path) {
            $path = sys_get_temp_dir() . '/simonett-ping-bundle-lock-';
        }

        $this->path = $path;
    }

    public function save(Key $key): void
    {
        file_put_contents($this->path . $key, 'lock');
    }

    public function waitAndSave(Key $key): void
    {
        $this->save($key);
    }

    public function putOffExpiration(Key $key, $ttl): void
    {
        throw new \Exception('');
    }

    public function delete(Key $key): void
    {
        if (! $this->exists($key)) {
            return;
        }

        unlink($this->path . $key);
    }

    public function exists(Key $key): bool
    {
        return file_exists($this->path . $key);
    }
}
