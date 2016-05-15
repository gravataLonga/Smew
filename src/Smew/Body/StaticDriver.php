<?php
namespace Gravatalonga\Smew\Body;

use Gravatalonga\Smew\Body\Contract\StoreBodyInterface;
use Michelf\Markdown;

class StaticDriver implements StoreBodyInterface
{
    protected $content;

    public function get()
    {
        return $this->content;
    }

    public function getRaw()
    {
        return $this->content;
    }

    public function set($str)
    {
        $this->content = $str;
    }

    public function append($str)
    {
        $this->content .= $str;
    }

    public function preppend($str)
    {
        $this->content = $str . $this->content;
    }

    public function partial($str)
    {
        return $str;
    }
}
