<?php

namespace Scandio\lmvc\modules\rendering\handlers;

use Scandio\lmvc\modules\rendering\interfaces;

abstract class AbstractHandler implements interfaces\RendererInterface
{
    protected
        $_renderArgs = [];

    abstract function render($renderArgs = [], $template = null);

    public function setRenderArgs($renderArgs, $merge = false)
    {
        $this->_renderArgs = ($merge) ? array_merge_recursive($this->_renderArgs, $renderArgs) : $renderArgs;
    }

    public function getRenderArgs()
    {
        return $this->_renderArgs;
    }

    public function getFile($path)
    {
        return file_get_contents($path);
    }
}