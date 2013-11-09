<?php

namespace Scandio\lmvc\modules\rendering\handlers;

class HtmlHandler extends AbstractHandler
{
    public function render($renderArgs = [], $template = null)
    {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1964 07:00:00 GMT');

        echo (string) $renderArgs;

        return true;
    }
}