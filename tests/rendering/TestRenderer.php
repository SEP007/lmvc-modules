<?php

use Scandio\lmvc\utils\logger\scribes\ChromeScribe;
use Scandio\lmvc\utils\config\Config;
use Scandio\lmvc\utils\string\StringUtils;
use Scandio\lmvc\modules\rendering\Renderer;

class TestRenderer extends PHPUnit_Framework_TestCase
{
    private
        $_rootPath     = null,
        $_templatePath = null,
        $_renderArgs   = null;

    protected function setUp()
    {
        $this->_rootPath     = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $this->_templatePath = $this->_rootPath . DIRECTORY_SEPARATOR . 'templates';

        Config::initialize($this->_rootPath . 'config.json');

        Config::get()->views = [$this->_rootPath . DIRECTORY_SEPARATOR . 'templates'];

        $this->_renderArgs = ['Homer', 'Marge', 'Bart'];
    }

    public function testRendererInstanceTypes()
    {
        $this->assertTrue(Renderer::get('php') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('html') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('json') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('smarty') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
        $this->assertTrue(Renderer::get('mustache') instanceof \Scandio\lmvc\modules\rendering\interfaces\RendererInterface);
    }

    public function testRenderingHtml()
    {
        $renderer = Renderer::get('html');
        $html     = $this->getTemplate('tmpl-html.html');

        $this->assertEquals($this->trim($renderer->render($html)), $this->trim($html));
    }

    private function getTemplate($name)
    {
        return file_get_contents($this->_templatePath . DIRECTORY_SEPARATOR . $name);
    }

    private function trim($string)
    {
        return preg_replace('/[\s]+/', ' ', $string);
    }
}