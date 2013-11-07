<?php
namespace Scandio\lmvc\modules\i18n;

use Scandio\lmvc\modules\i18n\controllers\I18n;

class I18nWrapper {
	
	public static function translate($text) {
		return I18n::translate($text);
	}
    
    public static function setLanguage($language) {
        //return I18n::setLanguage($language);
    }
    
    public static function index() {
        return I18n::index();
    }
}

?>