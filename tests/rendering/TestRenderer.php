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
        $this->_templatePath = $this->_rootPath . 'templates';

        Config::initialize($this->_rootPath . 'config.json');

        Config::get()->views = [$this->_rootPath . 'templates'];
        Config::get()->viewPath = ['templates'];

        $this->_renderArgs = ['users' => ['Homer', 'Marge', 'Bart']];
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

    public function testRenderingJson()
    {
        $renderer = Renderer::get('json');
        $json     = json_decode( $this->getTemplate('tmpl-json.json') );

        $this->assertEquals($this->trim($renderer->render($json)), $this->trim(json_encode($json)));
    }

    public function testRenderingJsonp()
    {
        $renderer           = Renderer::get('json');
        $json               = json_decode( $this->getTemplate('tmpl-json.json') );
        $_GET['callback']   = 'itssosecure';
        $jsonp              = $_GET['callback'] . '( return %s );';

        # ... pressing flush on the old render args
        $renderer->setRenderArgs([], false);

        $this->assertEquals(
          $this->trim(
            $renderer->render($json)
          ),
          $this->trim(
            sprintf($jsonp, json_encode($json))
          )
        );
    }

    public function testRenderingMustache()
    {
        $renderer   = Renderer::get('mustache');
        $mustache   = $this->getTemplate('tmpl-mustache.mustache');
        $html       = $this->getTemplate('tmpl-html.html');

        $renderer->setState(['appPath' => $this->_templatePath]);

        $this->assertEquals(
          $this->trim($renderer->render(
            $this->_renderArgs,
            'tmpl-mustache.mustache'
          )),
          $this->trim($html)
        );
    }

    public function testSearchView()
    {
        $renderer   = Renderer::get('mustache');
        $renderer->setState(['appPath' => $this->_rootPath]);

        $view = $renderer->searchView('tmpl-mustache.mustache');

        $this->assertEquals($view, $this->_templatePath . DIRECTORY_SEPARATOR . 'tmpl-mustache.mustache');
        $this->assertFalse($renderer->searchView('i-am-not-existent.mustache'));
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