<?php
namespace Gravatalonga\Smew\Page\Contract;

use Gravatalonga\Smew\Meta\Contract\MetaRepository;

interface Factory
{

    public function __construct(MetaRepository $meta);

    public function path($set = null);

    public function read();

    public function write();

    public function meta(MetaRepository $meta);
}
