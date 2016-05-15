<?php
namespace Gravatalonga\Smew\Finder;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class FinderServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        // Finder
        $container['finder'] = $container->factory(function ($c) {
            return new FinderManager($c);
        });

        // Filesystem
        $container['filesystem'] = function ($c) {
            return new Filesystem;
        };
    }
}
