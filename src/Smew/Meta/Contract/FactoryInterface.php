<?php
namespace Gravatalonga\Smew\Meta\Contract;

interface FactoryInterface
{
    public function driver($name);

    public function extend($drive, \Closure $callback);
}
