<?php
namespace Gravatalonga\Smew\Meta;

use Gravatalonga\Smew\Meta\Contract\StoreMeta;

class JsonDrive implements StoreMeta
{
    public $meta = [];

    protected $raw;

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
    }

    public function decode($content)
    {
        $this->meta = json_decode($content, true);
    }

    public function encode()
    {
        return json_encode($this->meta);
    }

    public function all()
    {
        return $this->meta;
    }
}
