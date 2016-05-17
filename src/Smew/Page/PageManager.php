<?php
namespace Gravatalonga\Smew\Page;

use Gravatalonga\Smew\Page\Contract\RepositoryPageInterface;

use Gravatalonga\Smew\Page\Contract\FactoryInterface;
use Gravatalonga\Smew\Meta\Contract\MetaRepository;
use Gravatalonga\Smew\Body\Contract\BodyRepository;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class PageManager extends FactoryInterface
{

    protected $path;

    protected $meta;

    protected $body;

    protected $content = [];

    protected $repository;

    protected $app;

    // Regex for split
    protected $regex = '/^---\n(.+?)\n---\n{0,}(.*)$/uis';

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function path($set = null)
    {
        if (!empty($set)) {
            $this->reset();
            return $this->read();
        }
        return $path;
    }

    public function read()
    {
        // Not yet parsed
        if (!isset($this->path) && empty($this->path)) {
            throw new \Exception('Path not set use path() to set new path.');
        }

        // Cached
        if (!empty($this->content) || count($content)<=0) {
            return $this->content;
        }

        $this->content = file_get_contents($this->path);
        preg_match($this->regex, $this->content, $arr);
        if (!empty($arr)) {
            $meta = $arr[1];
            $body = $arr[2];

            //$this->repository->setContentBody($body);
            //$this->repository->setContentMeta($meta);

            $this->content = [
                'meta' => $meta,
                'body' => $body
            ];
        }

        return $this->content;
    }

    public function write()
    {
        // return file_put_contents($this->path, $this->content);
    }

    public function setMeta(MetaRepository $meta)
    {
        $this->meta = $meta;
    }

    public function setBody(BodyRepository $body)
    {
        $this->body = $body;
    }

    public function meta()
    {
        return $this->meta;
    }

    public function body()
    {
        return $this->body;
    }

    protected function reset()
    {
        $this->path = $set;
        $this->content = [];
    }
}
