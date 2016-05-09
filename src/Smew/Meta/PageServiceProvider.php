<?php
namespace Gravatalonga\Smew\Meta;

use Gravatalonga\Smew\Container\Container;
use Gravatalonga\Smew\Container\ServiceProviderInterface;
use Gravatalonga\Smew\Meta\MetaManager;

class PageServiceProvider implements ServiceProviderInterface
{
    /**
     * register
     * @param  \Pimple\Container $container Pimple Container
     * @return \Gravatalonga\Smew\Contract\Store $page
     */
    public function register(\Pimple\Container $container)
    {
        $container['page'] = $container->factory(function ($c) {
            $content = new MetaManager();
            $page = $content->driver($c['page.drive']);
            return $page;
        });
    }
}
