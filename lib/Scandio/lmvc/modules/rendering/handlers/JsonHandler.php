<?php

namespace Scandio\lmvc\modules\rendering\handlers;

/**
 * Class JsonHandler
 * @package Scandio\lmvc\modules\rendering\handlers
 *
 * Serializes the render args to their Json representation.
 */
class JsonHandler extends AbstractHandler
{
    /**
     * Takes new render args, merges them with existing ones and serializes them to Json.
     *
     * Note:
     *  Uses the Jsonp callback from the GET array.
     *
     * @param array $renderArgs to be serialized
     *
     * @return bool always truethy
     */
    public function render($renderArgs = [])
    {
        $this->setRenderArgs($renderArgs, true);

        $this->setHeader('Cache-Control: no-cache, must-revalidate');
        $this->setHeader('Expires: Mon, 26 Jul 1964 07:00:00 GMT');

        $json = $this->_buildJson();

        if (isset($_GET['callback']) && !empty($_GET['callback'])) {
            $this->setHeader('Content-type: application/javascript');

            $callback = $_GET['callback'];

            $json = $callback . '( return ' . $json . ');';
        } else {
            $this->setHeader('Content-type: application/json');
        }

        echo $json;

        return $json;
    }

    /**
     * Encodes the render args to Json.
     *
     * @return string json encoded version of the render args
     */
    private function _buildJson()
    {
        return json_encode($this->getRenderArgs());
    }
}