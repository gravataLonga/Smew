<?php
namespace Gravatalonga\Smew\Meta;

use Gravatalonga\Smew\Meta\Contract\StoreMeta;

class SerializeDrive implements StoreMeta
{
    public $meta = [];

    public function put($meta, $value, $persist = true)
    {
        $this->meta[$meta] = $value;
    }

    public function raw()
    {
        return $this->raw;
    }

    public function fetch($meta, $default = null)
    {
        return isset($this->meta[$meta]) ? $this->meta[$meta] : $default;
    }

    public function resolve($content)
    {
        $this->raw = $content;
        $this->parseData($content);
    }

    public function decode($content)
    {
        $this->meta = unserialize($content);
    }

    public function encode($content)
    {
        return serialize($this->meta);
    }

    public function all()
    {
        return $this->meta;
    }
}
