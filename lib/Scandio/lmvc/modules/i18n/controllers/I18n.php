<?php
	namespace Scandio\lmvc\modules\i18n\controllers;
	
	use spyc\Spyc;
	use Scandio\lmvc\Controller;
	use Scandio\lmvc\modules\session\Session;
	
	class I18n extends Controller {
		
		//The language of the application, by default it is English
		private static $language = 'en';
		
		private static $translations = array();
		
		private static $selectedLanguages = array();
		
		private static $rootDirectory;
		
		static function initialize() {
			self::loadIfNeeded();
		}

		public static function setLanguage($language) {
			Session::set('language', $language, false); 
			self::loadIfNeeded();
			
			//redirect to page based on the Session
			//we have to handle the case where we redirect to another page
			//after an action
			$redirectPage = Session::get('redirectPage');
			self::redirectTo($redirectPage);
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
			self::$translations = spyc_load_file($filePath);
		}
		
		public static function configure($assetRootDirectory) {
			
			static::$rootDirectory = $assetRootDirectory;
			
			static::initialize();
		}
		
		public static function index() {
        	return static::redirect('I18n::languages');
    	}

		private static function redirectTo($page) {
			switch ($page) {
				case 'main.html':
					static::redirect('Register::main');
					break;
				
				default:
					static::redirect('Register::main');
					break;
			}
			
		}
	}
	
?>