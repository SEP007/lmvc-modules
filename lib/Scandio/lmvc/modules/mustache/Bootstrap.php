<?php

namespace Scandio\lmvc\modules\mustache;

use Scandio\lmvc\LVC;

class Bootstrap extends \Scandio\lmvc\utils\bootstrap\Bootstrap
{
    /**
     * Initialize the module
     */
    public function initialize()
    {
        LVC::registerControllerNamespace(new controllers\Mustache);
    }
}
