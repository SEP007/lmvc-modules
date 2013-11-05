<?php

namespace Scandio\lmvc\modules\security;

use Scandio\lmvc\LVC;
use Scandio\lmvc\modules\snippets\Snippets;

class Bootstrap extends \Scandio\lmvc\utils\bootstrap\Bootstrap
{
    /**
     * Registers the module controller namespace and the views directory
     */
    public function initialize()
    {
        LVC::registerControllerNamespace(new controllers\Security());
        LVC::registerViewDirectory(static::getPath() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
        Snippets::registerSnippetDirectory(self::getPath() . DIRECTORY_SEPARATOR . 'snippets');
    }
}