<?php

namespace Scandio\lmvc\modules\registration;

use Scandio\lmvc\LVC;
use Scandio\lmvc\modules\rendering\Renderer;

class Bootstrap extends \Scandio\lmvc\utils\bootstrap\Bootstrap
{
    /**
     * Registers the module controller namespace and the views directory
     */
    public function initialize()
    {
        LVC::registerControllerNamespace(new controllers\Registration());
        Renderer::registerViewDirectory(static::getPath() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
    }
}