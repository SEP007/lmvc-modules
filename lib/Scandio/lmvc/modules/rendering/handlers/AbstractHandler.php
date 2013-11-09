<?php

namespace Scandio\lmvc\modules\rendering\handlers;

use Scandio\lmvc\modules\rendering\interfaces;

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
        $_config     = null;

    # To be passed on the specific renderer
    abstract function render($renderArgs = [], $template = null);

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
        return $this->_config->extention;
    }
}