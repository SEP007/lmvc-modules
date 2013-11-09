<?php

namespace Scandio\lmvc\modules\rendering\handlers;

class SmartyHandler extends AbstractHandler
{
    public function render($renderArgs = [], $template = null)
    {
        $this->setRenderArgs($renderArgs, true);
    }
}