<?php
namespace Gravatalonga\Smew\File;

use Symfony\Component\Finder\Finder;

class FinderManager extends Finder
{
    protected $strBaseLocation;

    protected $finder;

    protected $strPatternFile = '*.smew';

    public function __construct($strBaseLocation)
    {
        parent::__construct();
        return $this->setBaseLocation($strBaseLocation);
    }

    public function setBaseLocation($set)
    {
        $files = $this->files()->in($set);

        $files->name($this->strPatternFile);

        $this->finder = $files;

        $this->strBaseLocation = $set;

        return $files;
    }
}
