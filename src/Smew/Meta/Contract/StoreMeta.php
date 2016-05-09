<?php
namespace Gravatalonga\Smew\Meta\Contract;

interface StoreMeta
{
    public function put($meta, $value, $persist = true);

    public function fetch($meta, $default = null);

    public function raw();

    public function decode($content);

    public function encode();

    public function all();
}
