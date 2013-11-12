<?php

namespace Scandio\lmvc\modules\rendering\handlers;

use Scandio\lmvc\utils\string\StringUtils;
use Scandio\lmvc\LVC;

/**
 * Class PhpHandler
 * @package Scandio\lmvc\modules\rendering\handlers
 *
 * Renders standard Php templates which are/were the default
 * in lmvc.
 */
class PhpHandler extends AbstractHandler
{
    /**
     * Renders a template the old fashioned way.
     * Executing the Php-snippets inside and extracting the
     * renderArgs to the global scope.
     *
     * @param array $renderArgs to be casted into string
     * @param null $template not used here
     *
     * @return bool always truethy
     */
    public function render($renderArgs = [], $templates = null)
    {
        extract($this->_renderArgs);
        $state  = $this->_state;
        $app    = LVC::get();

        if ( isset($templates['minor']) && $templates['minor'] != null ) {
            $app->view = $state['appPath'] . $templates['minor'];
        } else {
            $app->view = self::searchView(
              StringUtils::camelCaseTo($state['controller']) . DIRECTORY_SEPARATOR .
              StringUtils::camelCaseTo($state['action']) . "." .
              $this->getExtention()
            );
        }

        if ( isset($templates['major'])  && $templates['major'] != null) {
            $masterTemplate = $state['appPath'] . $masterTemplate;
        } else {
            $masterTemplate = $this->searchView('main.html');
        }

        include($masterTemplate);

        return true;
    }
}