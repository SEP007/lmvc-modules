<?php

namespace Scandio\lmvc\modules\rendering\handlers;

use Scandio\lmvc\modules\rendering\interfaces;
use Scandio\lmvc\utils\config\Config;

/**
 * Class AbstractHandler
 * @package Scandio\lmvc\modules\rendering\handlers
 *
 * Aggregates a set of common functionality among all renderer handlers.
 */
abstract class AbstractHandler implements interfaces\RendererInterface
{
    protected
        $_renderArgs = [],
        $_state      = [],
        $_config     = null;

    # To be passed on the specific renderer
    abstract function render($renderArgs = []);

    /**
     * Intializes renderer with config object
     *
     * @param $config object used to configure the renderer
     */
    public function initialize($config)
    {
        $this->_config = $config;
    }

    /**
     * Set or merge some render args into the renderer.
     *
     * @param array $renderArgs to be set
     * @param bool $merge if true renderArgs will be merged into existing ones
     */
    public function setRenderArgs($renderArgs = [], $merge = false)
    {
        $this->_renderArgs = ($merge) ? array_merge_recursive($this->getRenderArgs(), $renderArgs) : $renderArgs;
    }

    /**
     * Gets the currently set render args.
     *
     * @return array of render args
     */
    public function getRenderArgs()
    {
        return $this->_renderArgs;
    }

    /**
     * Gets a file's content by its $path.
     *
     * @param $path for which file stream should be loaded
     * @return string containing file's contents
     */
    public function getFile($path)
    {
        return file_get_contents($path);
    }

    /**
     * Returns the extension for specific renderer.
     *
     * @return string static the extension of renderer
     */
    public function getExtention()
    {
        return $this->_config->extension;
    }

    /**
     * Searches a view (fully qualified path) within one of the given viewPaths of the `config.json`
     *
     * @param $view
     * @return bool|string false if view could not be found otherwise a string containting the view's name
     */
    protected function searchView($view)
    {
        $config = Config::get();

        foreach ($config->viewPath as $path) {
            $viewPath = ((substr($path, 0, 1) == '/') ? '' : $this->_state['appPath']) . $path . DIRECTORY_SEPARATOR . $view;

            if (file_exists($viewPath)) {
                return $viewPath;
            }
        }

        return false;
    }

    /**
     * Sets the current applications state for later processing such
     * as patch guessing.
     *
     * @param $state of the application
     */
    public function setState($state)
    {
        $this->_state = $state;
    }
}