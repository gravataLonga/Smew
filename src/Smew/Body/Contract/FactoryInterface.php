<?php
namespace Gravatalonga\Smew\Body\Contract;

interface FactoryInterface
{
    public function driver($drive);

    public function extend($drive, Closure $callback);
}
