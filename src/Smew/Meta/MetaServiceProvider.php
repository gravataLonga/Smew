<?php
namespace Gravatalonga\Smew\Meta;

use Pimple\ServiceProviderInterface;
use Pimple\Container;
use Gravatalonga\Smew\Meta\MetaManager;

class MetaServiceProvider implements ServiceProviderInterface
{
    /**
     * register
     * @param  \Pimple\Container $container Pimple Container
     * @return \Gravatalonga\Smew\Contract\Store $page
     */
    public function register(Container $container)
    {
        $container['meta'] = function ($c) {
            $content = new MetaManager($c);
            $page = $content->driver('static');
            return $page;
        };
    }
}
