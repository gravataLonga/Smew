<?php
namespace Gravatalonga\Smew\Page\Contract;

interface RepositoryPageInterface
{
    public function __construct(PageManager $page);

    /**
     * body
     * @return [type] [description]
     */
    public function body();

    /**
     * meta
     * @return [type] [description]
     */
    public function meta();

    /**
     * save
     * @return [type] [description]
     */
    public function save();
}
