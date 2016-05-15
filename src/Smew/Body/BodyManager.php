<?php
namespace Gravatalonga\Smew\Body;

use Gravatalonga\Smew\Body\Contract\FactoryInterface;
use Gravatalonga\Smew\Body\Contract\StoreBodyInterface;

class BodyManager implements FactoryInterface
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

    protected function resolve($name)
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

    protected function getConfig($name)
    {
        return ['driver' => $name];
    }

    protected function createMarkdownDriver()
    {
        return $this->repository(new MarkdownDriver());
    }

    protected function createTextDriver()
    {
        return $this->repository(new StaticDriver());
    }

    protected function createHtmlDriver()
    {
        return $this->repository(new StaticDriver());
    }

    protected function repository(StoreBodyInterface $drive)
    {
        $repository = new Repository($drive);
        return $repository;
    }
}
