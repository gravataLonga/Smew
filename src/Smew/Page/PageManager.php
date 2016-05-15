<?php
namespace Gravatalonga\Smew\Page;

use Gravatalonga\Smew\Page\Contract\FactoryInterface;
use Gravatalonga\Smew\Meta\Contract\MetaRepository;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

class PageManager extends FactoryInterface
{

    protected $path;

    protected $meta;

    protected $content = [];

    // Regex for split
    protected $regex = '/^---\n(.+?)\n---\n{0,}(.*)$/uis';

    public function __construct(MetaRepository $meta)
    {
        $this->meta = $meta;
    }

    public function path($set = null)
    {
        if (!empty($set)) {
            $this->path = $set;
            $this->content = [];
        }
        return $path;
    }

    public function read()
    {
        if (!isset($this->path) && empty($this->path)) {
            throw new \Exception('Path not set use path() to set new path.');
        }

        if (!empty($this->content) || count($content)<=0) {
            return $this->content;
        }

        $this->content = file_get_contents($this->path);
        preg_match($this->regex, $this->content, $arr);
        if (!empty($arr)) {
            $this->content = [
                'meta' => $arr[1],
                'body' => $arr[2]
            ];
        }

        $this->parseMeta();

        return $this->content;
    }

    public function write()
    {
        return file_put_contents($this->path, $this->content);
    }

    public function meta(MetaRepository $meta)
    {
        $this->meta = $meta;
    }

    public function parseMeta()
    {
        if (isset($this->content['meta']) && !empty($this->content['meta'])) {
            $this->meta->read($this->content['meta']);
        }
    }
}
