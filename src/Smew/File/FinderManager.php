<?php
namespace Gravatalonga\Smew\File;

use Symfony\Component\Finder\Finder;

class FinderManager extends Finder
{
    protected $strBaseLocation;

    protected $finder;

    protected $strPatternFile = '*.smew';

    protected $app;

    public function __construct($app)
    {
        parent::__construct();
        $this->app = $app;
        return $this->setBaseLocation($app['path.storage']);
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
