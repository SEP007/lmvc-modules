<?php

namespace Scandio\lmvc\modules\rendering\handlers;

use Scandio\lmvc\modules\rendering\interfaces;

abstract class AbstractHandler implements interfaces\RendererInterface
{
    private
        $_renderArgs = [];

    abstract public function render($template);

    public static function setRenderArgs($renderArgs)
    {
        $this->_renderArgs = (array) $renderArgs;
    }
}