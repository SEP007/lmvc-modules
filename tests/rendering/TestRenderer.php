<?php

use Scandio\lmvc\utils\logger\scribes\ChromeScribe;
use Scandio\lmvc\utils\config\Config;
use Scandio\lmvc\utils\string\StringUtils;
use Scandio\lmvc\modules\rendering\Renderer;

class TestRenderer extends PHPUnit_Framework_TestCase
{
    private
        $_rootPath = null;

    protected function setUp()
    {
        $this->_rootPath = dirname(__FILE__) . DIRECTORY_SEPARATOR;

        Config::initialize($this->_rootPath . 'config.json');
    }

    public function testRendererInstanceTypes()
    {
        $this->assertTrue(Renderer::get('php') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('html') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('json') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('smarty') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('mustache') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
    }
}