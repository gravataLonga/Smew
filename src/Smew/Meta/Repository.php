<?php
namespace Gravatalonga\Smew\Meta;

use Gravatalonga\Smew\Meta\Contract\MetaRepositoryInterface;
use Gravatalonga\Smew\Meta\Contract\StoreMetaInterface;

class Repository implements MetaRepositoryInterface
{

    // Drive used
    protected $drive;

    // Path File
    protected $path;

    // Regex for split
    protected $regex = '/^---\n(.+?)\n---\n{0,}(.*)$/uis';

    // Semi Raw content
    protected $content = [
        'meta' => [],
        'content' => ''
    ];

    // Default Meta
    protected $defaultMeta = [
        'slug'              => '',
        'date'              => '',
        'publish_date'      => '',
        'author'            => [],
        'ssl'               => false,
        'redirect'          => false,
        'template'          => 'default',
        'routable'          => true,
        'visible'           => true,
        'plugins'           => [],
        'menu'              => [],
        'published'         => true,
        'proccess'          => 'plain' // html, markdown and plain.
    ];

    public function __construct(StoreMetaInterface $page)
    {
        $this->drive = $page;
    }

    public function fetch($meta, $default = null)
    {
        return $this->drive->fetch($meta, $default);
    }

    public function put($meta, $value)
    {
        $this->drive->put($meta, $value);
        return $this;
    }

    public function all()
    {
        return $this->drive->all();
    }

    public function read($strMeta)
    {
        $this->content['meta'] = $strMeta;

        $this->drive->decode($this->content['meta']);

        $this->mergeDefault();

        $content = $this->drive->all();

        return $content;
    }

    public function readFile($path)
    {
        $this->path = $path;

        // Get file content
        $content = file_get_contents($path);

        // May be we can't read file.
        if (!$content) {
            throw new \Exception('Can\'t read file : ' . $path);
        }

        // Parse Meta Tags
        $content = $this->parse($content);

        // Semi Raw Content
        $this->content = $content;
        
        if (isset($content['meta']) && !empty($content['meta'])) {
            // Decode
            $this->drive->decode($content['meta']);
        }

        // Clean and merge default configs
        $this->mergeDefault();

        $content = $this->drive->all();

        return $content;
    }

    public function save()
    {
        $meta = $this->drive->encode();

        $meta = preg_replace("/(\r\n|\r)/", "\n", $meta);

        return $meta;
    }

    public function saveFile()
    {
        $meta = $this->drive->encode();

        $o = "---\n" . trim($meta) . "\n---\n\n" . $this->content['content'];

        $o = preg_replace("/(\r\n|\r)/", "\n", $o);

        return @file_put_contents($this->path, $o);
    }

    protected function mergeDefault()
    {
        // Read Meta
        $meta = $this->drive->all();

        // Merge Default Meta Tags
        $content = array_merge($this->defaultMeta, $meta);

        foreach ($content as $k => $v) {
            $this->drive->put($k, $v);
        }
    }

    protected function parse($str)
    {
        $content = [
            'meta' => [],
            'content' => ''
        ];
        // Normalize line endings to Unix style.
        $str = preg_replace("/(\r\n|\r)/", "\n", $str);
        preg_match($this->regex, ltrim($str), $arr);
        if (!empty($arr)) {
            $content['content'] = $arr[2];
            $content['meta'] = $arr[1];
        }

        return $content;
    }
}
