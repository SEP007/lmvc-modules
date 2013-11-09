<?php

namespace Scandio\lmvc\modules\rendering\handlers;

class MustacheHandler extends AbstractHandler
{
    private
        $_mustacheEngine = null;

    function __construct()
    {
        parent::__construct();

        $this->_mustacheEngine = new \Mustache_Engine();
    }

    public function render($template)
    {
        return $this->_mustacheEngine->render(
            $this->getFile($template),
            $this->getRenderArgs()
        );
    }
}