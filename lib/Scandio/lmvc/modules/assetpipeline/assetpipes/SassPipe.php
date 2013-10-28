<?php

namespace Scandio\lmvc\modules\assetpipeline\assetpipes;

/**
 * Class SassPipe
 * @package Scandio\lmvc\modules\assetpipeline\assetpipes
 *
 * Pipe responsible for Sass files.
 */
class SassPipe extends AbstractAssetPipe
{

    protected static
        $_contentType   = "text/css";

    private
        $_sassCompiler;

    function __construct()
    {
        $this->_sassCompiler = new \scssc();

        parent::__construct();
    }

    private function _min($css)
    {
        return \CssMin::minify($css);
    }

    private function _compile($asset)
    {
        return $this->_sassCompiler->compile(file_get_contents($asset));
    }

    /**
     * The abstract process method to be called whenever file needs to be handled by this pipe.
     *
     * @param $asset which should be processed by this pipe (its filepath)
     * @param array $options to be applied on asset (e.g. min)
     * @param string describing errors during file location process
     *
     * @return string containing the processed file's content
     */
    public function process($asset, $options = [], $errors = '')
    {
        $css = null;

        if (!$this->_hasDefaultMimeType($asset)) {
            $css = $this->_compile($asset);

            if (in_array('min', $options)) {
                $css = $this->_min($css);
            }

            $css = $this->comment($errors, $css);
        } else {
            $css = file_get_contents($asset);
        }

        return $css;
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
        if (strlen($comment) > 0) {
            return "/*\n$comment\n*/\n\n".$toAssetContent;
        } else {
            return $toAssetContent;
        }
    }
}