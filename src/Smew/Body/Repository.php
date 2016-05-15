<?php
namespace Gravatalonga\Smew\Body;

use Gravatalonga\Smew\Body\Contract\BodyRepositoryInterface;

class Repository implements BodyRepositoryInterface
{
    protected $body;

    public function __construct(StoreBodyInterface $body)
    {
        $this->body = $body;
    }
}
