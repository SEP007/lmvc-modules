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
        $this->setRenderArgs($renderArgs, true);

        # Extract renderArgs to make them globally available in template
        extract($this->_renderArgs);
        # Shorthand these for later
        $state  = $this->_state;
        $app    = LVC::get();

        # If a minor template is specified directly use it under from the app path
        if ( isset($templates['minor']) && $templates['minor'] != null ) {
            $app->view = $state['appPath'] . $templates['minor'];
            var_dump($app->view);
        } else {
            # ... otherwise go on a wild hunt searching for it
            $app->view = self::searchView(
              $this->getPathByState()
            );
        }

        # Same for the master template, if specified take it
        if ( isset($templates['major'])  && $templates['major'] != null) {
            $masterTemplate = $state['appPath'] . $masterTemplate;

            # ... set to false for homogeneous variable value
            if ( !file_exists($masterTemplate)) { $masterTemplate = false; }
        } else {
            # ... else fallback to default as `main.html`
            $masterTemplate = $this->searchView('main.html');
        }

        if ($masterTemplate !== false) {
            # includes major template which should have a minor inside
            include($masterTemplate);

            return $masterTemplate;
        } else {
            include($app->view);

            return $app->view;
        }
    }
}