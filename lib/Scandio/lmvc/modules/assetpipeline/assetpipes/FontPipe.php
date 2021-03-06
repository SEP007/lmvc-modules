<?php

namespace Scandio\lmvc\modules\assetpipeline\assetpipes;

/**
 * Class CssPipe
 * @package Scandio\lmvc\modules\assetpipeline\assetpipes
 *
 * Handles font files processed by pipe.
 */
class FontPipe extends AbstractAssetPipe
{

    protected static
        $_contentType   = "text/font";

    function __construct()
    {
        parent::__construct();
    }

    /**
     * The abstract process method to be called whenever file needs to be handled by this pipe.
     *
     * @param $asset which should be processed by this pipe (its filepath)
     * @param array $options to be applied on asset
     * @param string describing errors during file location process
     *
     * @return string containing the processed file's content
     */
    public function process($asset, $options = [], $errors = '')
    {
        $css    = null;
        $font   = file_get_contents($asset);

        return $font;
    }

    /**
     * The abstract comment method to be called whenever a comment shall be prepended to file
     *
     * @param $comment string being comment to be prepended
     * @param $toAssetContent string of processed file-content to which comment should be prepended
     *
     * @return $file-content with possible content prepended
     */
    public function comment($comment, $toAssetContent)
    {
        #Noop, comment prepending would break binary file
        return;
    }
}