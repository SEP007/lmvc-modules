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
		
		static function init() {
			// Session::set('language', self::$language, false);
			self::loadIfNeeded();
		}

		public static function setLanguage($language) {
			Session::set('language', $language, false); 
			self::loadIfNeeded();
		}
		
		public static function translate($key) {
			if (array_key_exists($key, self::$translations)) {
    			return self::$translations[$key];
			}
			else {
				return $key;
			}
		}
		
		// have to check based on the Session
		private static function loadIfNeeded() {
			$lang = Session::get('language');
			
			if(!isset($lang)) {
				$lang = 'en';
				Session::set('language', $lang, false);
			}
			
// 			attempt for caching
			if (in_array($lang, self::$selectedLanguages)) {
				// echo 'File' . $lang . ' not loaded';
				return;
			}
			
			array_push(self::$selectedLanguages, $lang);
			// 			attempt for caching
			// foreach(self::$selectedLanguages as $lan) {
				// echo $lan;
			// } 
			
			$filePath = 'app/locales/' . $lang . '.yaml';
			self::loadFile($filePath);
		}
		
		private static function loadFile($filePath) {
			if(!file_exists($filePath)) {
				$filePath = 'app/locales/' . self::$language . '.yaml';
				//We must write that to the logger
				 //echo 'missing file ' . $filePath; 
			}
			self::$translations = spyc_load_file($filePath);
		}
		
	}
	//forcing the files to load
	I18n::init();
	
?>