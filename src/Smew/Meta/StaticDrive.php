<?php
namespace Gravatalonga\Smew\Meta;

use Gravatalonga\Smew\Meta\Contract\StoreMeta;

class StaticDrive implements StoreMeta
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
    }

    public function decode($content)
    {
        preg_match_all('/(.+)\:\s(.+)/', $content, $arr);
        
        $arrPairs = [];

        if (isset($arr) && count($arr)>0) {
            foreach ($arr[1] as $i => $key) {
                $key = trim($key);
                $value = isset($arr[2][$i]) ? $arr[2][$i] : '';
                $arrPairs[$key] = trim($value);
            }
        }

        $this->meta = $arrPairs;
    }

    public function encode()
    {
        $arrLine = [];
        foreach ($this->meta as $k => $v) {
            if (isset($v) && !empty($v)) {
                $arrLine[] = $k.':'.$v;
            }
        }
        return implode("\n", $arrLine);
    }

    public function all()
    {
        return $this->meta;
    }
}
