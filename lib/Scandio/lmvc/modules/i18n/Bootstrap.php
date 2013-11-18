<?php

namespace Scandio\lmvc\modules\i18n;

use Scandio\lmvc\LVC;

class Bootstrap extends \Scandio\lmvc\utils\bootstrap\Bootstrap
{
		
	public static function configure($assetRootDirectory)
	{
		I18nWrapper::loadFile($assetRootDirectory);
	}
	
	/**
     * Registers the module controller namespace and the views directory
     */
    public function initialize()
    {
        LVC::registerControllerNamespace(new controllers\I18n());
    }

}