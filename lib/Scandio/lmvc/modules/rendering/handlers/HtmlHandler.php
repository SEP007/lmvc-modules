<?php

namespace Scandio\lmvc\modules\rendering\handlers;

/**
 * Class HtmlHandler
 * @package Scandio\lmvc\modules\rendering\handlers
 *
 * Renders passed in Html, pipes it through.
 */
class HtmlHandler extends AbstractHandler
{
    /**
     * Pipes an Html string.
     *
     * @param array $renderArgs to be casted into string
     *
     * @return bool always truethy
     */
    public function render($renderArgs = [])
    {
        $this->setHeader('Cache-Control: no-cache, must-revalidate');
        $this->setHeader('Expires: Mon, 26 Jul 1964 07:00:00 GMT');

        echo (string) $renderArgs;

        return (string) $renderArgs;
    }
}