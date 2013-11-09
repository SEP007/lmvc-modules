<?php

namespace Scandio\lmvc\modules\rendering\handlers;

/**
 * Class SmartyHandler
 * @package Scandio\lmvc\modules\rendering\handlers
 *
 * Renders a smarty template with the set render args.
 */
class SmartyHandler extends AbstractHandler
{
    /**
     * Renders a smarty template at a path.
     *
     * @param array $renderArgs render args to be made available to template
     * @param null $template string to template file
     */
    public function render($renderArgs = [], $template = null)
    {
        $this->setRenderArgs($renderArgs, true);
    }
}