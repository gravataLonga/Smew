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
        $container['filesystem'] = function ($c) {
            return new Filesystem();
        };

        $container['finder'] = function ($c) {
            $finder = new FinderManager($c['path.storage']);
            return $finder;
        };
    }
}
