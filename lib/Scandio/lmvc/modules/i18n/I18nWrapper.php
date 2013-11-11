<?php
    namespace Scandio\lmvc\modules\i18n;
    
    use Scandio\lmvc\modules\i18n\controllers\I18n;
    use Scandio\lmvc\modules\session\Session;
    use Scandio\lmvc\LVCConfig;
    use Scandio\lmvc\modules\i18n\handler\YamlHandler;
    
    class I18nWrapper {
        
        private static 
            $language = null,
            $translations = array(),
            $selectedLanguages = array();
        
        //this will do the caching later on
        public static function loadIfNeeded($rootDirectory) {        
            static::$language = Session::get('i18n.language', LVCConfig::get()->I18n->default);
       
            /*if the language is not stored this means we have used
             *it in the past and thus the file is already loaded.
             */
            if(!self::storeSelectedLanguage(static::$language))
                return;
            
            $filePath = $rootDirectory . 
                            DIRECTORY_SEPARATOR . LVCConfig::get()->I18n->path . 
                            DIRECTORY_SEPARATOR . static::$language . '.yaml';
                            
            self::loadFile($filePath);
         }
            
        private static function loadFile($filePath) {
            if(!file_exists($filePath)) {
                 // write in the logger
            }
    
            self::$translations = YamlHandler::loadFile($filePath);
        }
        
        public static function translate($key) 
        {
            if (array_key_exists($key, self::$translations)) {
                return self::$translations[$key];
            }
            else {
                return $key;
            }
        }
        
        public static function getLanguage()
        {
            return Session::get('i18n.language', static::$language);
        }
        
        private static function storeSelectedLanguage($language) 
        {
            static::$selectedLanguages = Session::get('i18n.selectedLanguages', []);
            
            if(!in_array($language, static::$selectedLanguages)) {
               array_push(static::$selectedLanguages, $language);
               Session::set('i18n.selectedLanguages', static::$selectedLanguages); 
               
               return true;
            }
            
            return false;
        }
        
    }

?>