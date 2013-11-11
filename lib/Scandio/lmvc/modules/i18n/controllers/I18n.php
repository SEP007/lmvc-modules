<?php
	namespace Scandio\lmvc\modules\i18n\controllers;
	
	use Scandio\lmvc\Controller;
	use Scandio\lmvc\modules\session\Session;
    use Scandio\lmvc\modules\i18n\handler\YamlHandler;
    use Scandio\lmvc\LVCConfig;
	
	class I18n extends Controller {
        
        public static function index()
        {
            return static::redirect('I18n::language', LVCConfig::get()->I18n->default);
        }
		
		public static function language($language) {
        	Session::set('i18n.language', $language);
            
            $uri = Session::get('i18n.origin');
            Session::set('i18n.origin', null);

            /* this will redirect us to the origin page.
             * the redirect function does not work here for some reason
             */
            header( 'Location: ' . $uri ) ;
    	}
        

        public static function preProcess() {
            // we need to go back to where we came from            
            Session::set('i18n.origin', $_SERVER['HTTP_REFERER']);
            
            return true;
        }
	}
	
?>