<?php
namespace Gravatalonga\Smew\Page;

use Pimple\Container;
use Pimple\ServiceProvider;

class PageServiceProvider implements ServiceProvider
{
    public function register(Container $container)
    {
        $container['page'] = $container->factory(function ($c) {
            return new PageManager($c);
        });
    }
}
