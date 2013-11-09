<?php

namespace Scandio\lmvc\modules\rendering\handlers;

/**
 * Class MustacheHandler
 * @package Scandio\lmvc\modules\rendering\handlers
 *
 * Renders a mustache template with the set render args.
 */
class MustacheHandler extends AbstractHandler
{
    private
        $_mustacheEngine = null;

    /**
     * Constructor creating Mustache Engine.
     */
    function __construct()
    {
        parent::__construct();

        $this->_mustacheEngine = new \Mustache_Engine();
    }

    /**
     * Renders a given mustache template with the render args.
     *
     * @param array $renderArgs to be made accessible in mustache template
     * @param null $template string to template file
     *
     * @return string rendered mustache template
     */
    public function render($renderArgs = [], $template)
    {
        $this->setRenderArgs($renderArgs, true);

        return $this->_mustacheEngine->render(
            $this->getFile($template),
            $this->getRenderArgs()
        );
    }
}