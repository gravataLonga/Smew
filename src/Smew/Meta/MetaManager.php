<?php
namespace Gravatalonga\Smew\Meta;

use Gravatalonga\Smew\Meta\Contract\Factory;
use Gravatalonga\Smew\Meta\Contract\StoreMeta;
use Gravatalonga\Smew\Container\Container;

class MetaManager implements Factory
{
    public function driver($name)
    {
        return $this->resolve($name);
    }

    private function resolve($name)
    {
        $driverMethod = 'create'.ucfirst($name).'Driver';
        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}([]);
        } else {
            throw new InvalidArgumentException("Driver [{$config['driver']}] is not supported.");
        }
    }

    protected function createStaticDriver(array $config)
    {
        return $this->repository(new StaticDrive);
    }

    protected function createJsonDriver(array $config)
    {
        return $this->repository(new JsonDrive);
    }

    protected function createSerializeDriver(array $config)
    {
        return $this->repository(new SerializeDrive);
    }

    public function repository(StoreMeta $drive)
    {
        $repository = new Repository($drive);
        return $repository;
    }
}
