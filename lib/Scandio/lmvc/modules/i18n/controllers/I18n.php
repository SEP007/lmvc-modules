<?php
	namespace Scandio\lmvc\modules\i18n\controllers;
	
	use Scandio\lmvc\Controller;
	use Scandio\lmvc\modules\session\Session;
    use Scandio\lmvc\modules\i18n\handler\YamlHandler;
	
	class I18n extends Controller {
		
		//The language of the application, by default it is English
		private static $language = 'en';
		
		private static $translations = array();
		
		private static $selectedLanguages = array();
		
		private static $rootDirectory;
        
		static function initialize() {
			self::loadFileAndRedirect();
		}

		public static function setLanguage($language) {
			Session::set('language', $language, false); 
			self::loadFileAndRedirect();
		}
		
		public static function translate($key) {
			if (array_key_exists($key, self::$translations)) {
    			return self::$translations[$key];
			}
			else {
				return $key;
			}
		}
		
		private static function loadIfNeeded() {
			$lang = Session::get('language');
			
			if(!isset($lang)) {
				$lang = 'en';
				Session::set('language', $lang, false);
			}
			
			$filePath = self::$rootDirectory . '/locales/' . $lang . '.yaml';
			self::loadFile($filePath);
		}
		
		private static function loadFile($filePath) {
			if(!file_exists($filePath)) {
				$filePath = self::$rootDirectory . '/locales/'. self::$language . '.yaml';
				//We must write that to the logger
				 //echo 'missing file ' . $filePath; 
			}
            //should be with YamlHandler
			self::$translations = YamlHandler::loadFile($filePath);
		}
		
		public static function configure($assetRootDirectory) {
			
            static::preProcess();
            
			static::$rootDirectory = $assetRootDirectory;
			
			static::initialize();
		}
		
		public static function index() {
        	return static::redirect('I18n::languages');
        	// self::renderHtml(include('../views/languages.html'));
    	}
        
        /**
          * @return bool
        */
        public static function preProcess() {
            if (!parent::preProcess()) {
                return false;
            }
            
            Session::set('originPage', $_SERVER['REQUEST_URI']);
        }
        
        private static function loadFileAndRedirect() {
            self::loadIfNeeded();
            $page = Session::get('originPage');
            $redirect = self::whereToRedirect($page);
            static::redirect($redirect);
        }
        
        private static function whereToRedirect($page) {
            $reditectTo;
            switch($page) {
                case '':
                    $reditectTo = self::$originalPage;
                break;
                    
                case '/lmvc-patat/registration/signup':
                    $reditectTo = 'Registration::signup';
                break;
                
                case '/lmvc-patat/registration/edit':
                    $reditectTo = 'Registration::edit';
                break;
                
                case '/lmvc-patat/registration/failure':
                    $reditectTo = 'Registration::failure';
                break;
                
                case '/lmvc-patat/registration/success':
                    $reditectTo = 'Registration::success';
                break;
                
                case '/lmvc-patat/menu/edit':
                    $reditectTo = 'Menu::edit';
                break;
                
                case '/lmvc-patat/menu/index':
                    $reditectTo = 'Menu::index';
                break;
                
                case '/lmvc-patat/dishes/index':
                    $reditectTo = 'Dishes::index';
                break;
                
                case '/lmvc-patat/dishes/map':
                    $reditectTo = 'Dishes::map';
                break;
                
                default: 
                    $redirectTo = 'Application::index';

                return $redirectTo;
            }
        }
			
	}
	
?>