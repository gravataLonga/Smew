<?php
namespace Gravatalonga\Smew\Container;

use Pimple\ServiceProviderInterface as BaseInterface;

interface ServiceProviderInterface extends BaseInterface
{
    public function register(\Pimple\Container $pimple);
}
