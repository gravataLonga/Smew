<?php
namespace Gravatalonga\Smew\Meta\Contract;

interface MetaRepository
{
    public function put($meta, $value);

    public function fetch($meta, $default = null);

    public function read($strMeta);

    public function readFile($path);

    public function save();

    public function saveFile();
}
