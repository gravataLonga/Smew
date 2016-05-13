<?php
namespace Gravatalonga\Smew\Meta;

use Gravatalonga\Smew\Meta\Contract\FactoryInterface;
use Gravatalonga\Smew\Meta\Contract\StoreMetaInterface;

class MetaManager implements FactoryInterface
{
    protected $app;

    protected $customDriver = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function driver($name)
    {
        return $this->resolve($name);
    }

    private function resolve($name)
    {
        $config = $this->getConfig($name);

        if (isset($this->customDriver[$config['driver']])) {
            return $this->callCustomCreator($config);
        }

        $driverMethod = 'create'.ucfirst($name).'Driver';
        if (method_exists($this, $driverMethod)) {
            return $this->{$driverMethod}([]);
        } else {
            throw new \InvalidArgumentException("Driver [{$config['driver']}] is not supported.");
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

    protected function extend($drive, Closure $callback)
    {
        $this->customDriver[$drive] = $callback;
    }

    protected function callCustomCreator(array $config)
    {
        $driver = $this->customDriver[$config['driver']]($this->app, $config);

        if ($driver instanceof StoreMetaInterface) {
            return $this->repository($driver);
        }
        return $driver;
    }

    protected function getConfig($name)
    {
        return ['driver' => $name];
        // return $this->app['config']["filesystems.disks.{$name}"];
    }

    public function repository(StoreMetaInterface $drive)
    {
        $repository = new Repository($drive);
        return $repository;
    }
}
