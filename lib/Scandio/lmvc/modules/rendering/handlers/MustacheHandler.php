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
        $this->_mustacheEngine = new \Mustache_Engine();
    }

    /**
     * Renders a given mustache template with the render args.
     *
     * @param array $renderArgs to be made accessible in mustache template
     *
     * @return string rendered mustache template
     */
    public function render($renderArgs = [], $template = null)
    {
        $this->setRenderArgs($renderArgs, true);

        if ( is_string($template) ) {
            $mustacheTemplate = $this->_state['appPath'] . DIRECTORY_SEPARATOR . $template;
        } else {
            $mustacheTemplate = $this->searchView( $this->getPathByState() );
        }

        $mustache = $this->_mustacheEngine->render(
          $this->getFile($mustacheTemplate),
          $this->getRenderArgs()
        );

        echo $mustache;

        return $mustache;
    }
}