<?php

namespace Scandio\lmvc\modules\rendering\handlers;

class JsonHandler extends AbstractHandler
{
    public function render($renderArgs = [], $template = null)
    {
        $this->setRenderArgs($renderArgs, true);

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1964 07:00:00 GMT');

        $json = $this->_buildJson();

        if (isset($_GET['callback']) && !empty($_GET['callback'])) {
            header('Content-type: application/javascript');

            $callback = $_GET['callback'];

            $json = $callback . '( return ' . $json . ');';
        } else {
            header('Content-type: application/json');
        }

        echo $json;

        return true;
    }

    private function _buildJson()
    {
        return json_encode($this->getRenderArgs());
    }
}