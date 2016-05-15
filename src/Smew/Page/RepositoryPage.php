<?php
namespace Gravatalonga\Smew\Page;

use Gravatalonga\Smew\Page\Contract\RepositoryPageInterface;

class RepositoryPage implements RepositoryPageInterface
{
    protected $page;
    
    public function __construct(PageManager $page)
    {
        $this->page = $page;
    }
}
