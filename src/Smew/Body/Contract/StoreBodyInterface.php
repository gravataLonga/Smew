<?php
namespace Gravatalonga\Smew\Body\Contract;

interface StoreBodyInterface
{
    public function get();

    public function getRaw();

    public function set($str);

    public function append($str);

    public function preppend($str);

    public function partial($str);
}
