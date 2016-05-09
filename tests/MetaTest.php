<?php

use Gravatalonga\Smew\Meta\MetaManager;
use Gravatalonga\Smew\Meta\Repository;

class MetaTest extends PHPUnit_Framework_TestCase
{
    /**
     * testInstanceOf Repository::class
     * @return [type] [description]
     */
    public function testInstanceOfJson()
    {
        $content = new MetaManager();
        $page = $content->driver('json');
        $this->assertInstanceOf(Repository::class, $page);
        $content = new MetaManager();
        $page = $content->driver('static');
        $this->assertInstanceOf(Repository::class, $page);
    }

    /**
     * testParseFileStaticMeta
     * Check if Static Drive work ok.
     * @return [type] [description]
     */
    public function testParseFileStaticMeta()
    {
        $content = new MetaManager();
        $page = $content->driver('static');
        $meta = $page->readFile('./tests/file/StaticText.txt');
        $this->assertTrue($meta['custom'] == 'me', 'Custom Attribute was not readed!');
        $this->assertEquals('2016-05-08 11:13:03', $meta['date'], 'Date was changed');
    }

    /** 
     * testParseFileJsonMeta
     * Test if merge default meta tags not change custom attributes.
     * @return [type] [description]
     */
    public function testParseFileJsonMeta()
    {
        $content = new MetaManager();
        $page = $content->driver('json');
        $meta = $page->readFile('./tests/file/JsonText.txt');
        $this->assertTrue($meta['custom'] == 'me', 'Custom Attribute was not readed!');
        $this->assertTrue($meta['date'] == '2016-05-08 11:13:03', 'Date was changed');
    }

    /**
     * testCheckIfPartialMetaMergeDefault
     * Check if Partial Meta data was merged.
     * @return [type] [description]
     */
    public function testCheckIfPartialMetaMergeDefault()
    {
        $content = new MetaManager();
        $page = $content->driver('json');
        $meta = $page->readFile('./tests/file/InPartialText.txt');
        $this->assertTrue(json_encode($page->all()) == '{"text":"sample","slug":"","date":"","publish_date":"","author":[],"ssl":false,"redirect":false,"template":"default","routable":true,"visible":true,"plugins":[],"menu":[],"published":true,"proccess":"plain"}', 'Default Meta Tags wans\'t merged');
    }
}
