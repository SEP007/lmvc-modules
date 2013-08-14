<?php

namespace Scandio\lmvc\modules\assetpipeline\assetpipes;

use Scandio\lmvc\modules\assetpipeline\interfaces;
use Scandio\lmvc\modules\assetpipeline\controllers;
use Scandio\lmvc\modules\assetpipeline\util;

/**
 * Class AbstractAssetPipe
 * @package Scandio\lmvc\modules\assetpipeline\assetpipes
 *
 * Abstract asset pipeline to implement a set of interface functions while declaring process() abstract forcing each pipe
 * to implement it.
 *
 * After all, aggregating some functionality normally common for all pipes.
 */
abstract class AbstractAssetPipe implements interfaces\AssetPipeInterface
{

    protected
        $_fileLocator,
        $_defaultMimeTypes;

    protected static
        $_contentType;

    #Each pipe is responsible for this
    abstract public function process($asset, $options = []);

    function __construct()
    {
        #each pipe uses its own file locator
        $this->_fileLocator = new util\FileLocator();

        $config = json_decode(dirname(dirname(__FILE__)) . '/config.json');
        $this->_defaultMimeTypes = $config->mimeTypes;
    }

    /**
     * Sets the response content-type appropriately so that browsers display content correctly.
     *
     * @param string $asset  for which default mimeTypes is requested
     *
     * @return mixed false if no default mimeType is specified otherwise string indicating mime-type
     */
    protected function _defaultHttpHeader($asset)
    {
        $extension = pathinfo($asset, PATHINFO_EXTENSION);

        if (isset($this->_defaultMimeTypes[$extension])) {
            header("Content-Type: " . $this->_defaultMimeTypes[$extension]);
        } else {
            $this->_setHttpHeaders();
        }
    }

    /**
     * Sets a default mime-type if specified in config under mimeTypes directive per extension.
     */
    protected function _setHttpHeaders()
    {
        #Nothing more complicated up to now
        header("Content-Type: " . static::$_contentType);
    }

    /**
     * Registers pipe at controller based on its pipe type.
     *
     * @param array $types  to be registered upon which pipe will get notified (e.g. [css]) also defines
     *                      controller path (e.g. assetpipe/css/styles.scss)
     */
    public static function register($types, $options = [])
    {
        #late static binding goodness
        controllers\AssetPipeline::registerAssetpipe($types, get_called_class(), $options);
    }

    /**
     * Gives stream of data which has been processed by pipe below in object-graph (css|js...-pipe).
     *
     * @param array $assets which should be processed by pipe
     * @param array $options to be possibly performed on assets
     *
     * @return string containing the stream which has been processed
     */
    public function serve($assets = [], $paths, $options = [])
    {
        $servedContent = "";

        #only if cache has been initialized
        if ($this->_fileLocator->initializeCache($assets, $paths, $options)) {
            #the served content is either read from cache
            $servedContent = $this->_fileLocator->isCached() ?
                $this->_fileLocator->fromCache() :
                #or generated by being processed and cached
                $this->_fileLocator->cache($this->process($this->_fileLocator->concat(), $options));
        }

        #sets correct content type on output after processing: gives pipe chance ot overwrite
        $this->_defaultHttpHeader($assets[0]);

        return $servedContent;
    }

    /**
     * Sets and delegates pipe's cache directory to file locator.
     *
     * @param string $cacheDirectory to be used for caching resources
     */
    public function setCacheDirectory($cacheDirectory)
    {
        $this->_fileLocator->setCacheDirectory($cacheDirectory);
    }

    /**
     * @param boolean $flag indicating if sub directories should be used
     */
    public function useFolders($flag) {
        $this->_fileLocator->useFolders($flag);
    }

    /**
     * Sets and delegates asset-directory and fallbacks to file locator.
     *
     * @param string $assetDirectory where ordinary assets can be found
     * @param array $fallbacks if nothing was found, all these fallbacks shall be used
     */
    public function setAssetDirectory($assetDirectory, $fallbacks = [], $assetRootDirectory = '')
    {
        $this->_fileLocator->setAssetDirectory($assetDirectory, $fallbacks, $assetRootDirectory);
    }
}