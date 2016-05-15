<?php
namespace Gravatalonga\Smew\Body\Contract;

interface BodyRepositoryInterface
{
    public function __construct(StoreBodyInterface $body);

    public function read();
    
    public function write();
}
