<?php

namespace Scandio\lmvc\modules\rendering\handlers;

use Scandio\lmvc\utils\config\Config;

/**
 * Class SmartyHandler
 * @package Scandio\lmvc\modules\rendering\handlers
 *
 * Renders a smarty template with the set render args.
 */
class SmartyHandler extends AbstractHandler
{
    private
        $_smartyEngine = null;

    function __construct()
    {
        $this->_smartyEngine = new \Smarty();
    }

    public function initialize($config)
    {
        parent::initialize($config);

        $this->_smartyEngine->setTemplateDir($config->directories->template);
        $this->_smartyEngine->setCompileDir($config->directories->compile);
        $this->_smartyEngine->setCacheDir($config->directories->cache);
        $this->_smartyEngine->setConfigDir($config->directories->config);
    }

    /**
     * Renders a smarty template at a path.
     *
     * @param array $renderArgs render args to be made available to template
     * @param null $template string to template file
     */
    public function render($renderArgs = [], $template = null)
    {
        $this->setRenderArgs($renderArgs, true);
        $state  = $this->_state;

        # assigns all renders args to smarty
        foreach($this->getRenderArgs() as $argKey => $arg){
            $this->_smartyEngine->assign($argKey, $arg);
        }

        # checks if a a template is set otherwise search for a view by state
        if ( is_string($template) ) {
            $smartyTemplate = $this->_state['appPath'] . DIRECTORY_SEPARATOR . $template;
        } else {
            $smartyTemplate = $this->searchView( $this->getPathByState() );
        }

        $html = $this->_smartyEngine->fetch($smartyTemplate);

        echo $html;

        return $html;
    }
}