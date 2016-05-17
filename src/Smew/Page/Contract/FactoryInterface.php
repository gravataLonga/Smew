<?php
namespace Gravatalonga\Smew\Page\Contract;

use Gravatalonga\Smew\Meta\Contract\MetaRepositoryInterface;
use Gravatalonga\Smew\Body\Contract\BodyRepositoryInterface;

interface FactoryInterface
{

    public function __construct(\Pimple\Container $app);

    public function path($set = null);

    public function read();

    public function write();

    public function setMeta(MetaRepository $meta);

    public function setBody(BodyRepository $body);

    public function meta();

    public function body();
}
