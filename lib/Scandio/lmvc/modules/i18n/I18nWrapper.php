<?php
    namespace Scandio\lmvc\modules\i18n;
    
    use Scandio\lmvc\utils\config\Config;
    use Scandio\lmvc\modules\i18n\controllers\I18n;
    use Scandio\lmvc\modules\session\Session;
    use Scandio\lmvc\modules\i18n\handler\YamlHandler;
    use Scandio\lmvc\modules\i18n\handler\JsonHandler;
    
    class I18nWrapper {
        
        private static 
            $language = null,
            $translations = array(),
            $selectedLanguages = array();
        
        public static function loadIfNeeded($rootDirectory) {        
            static::$language = Session::get('i18n.language', Config::get()->I18n->default);
       
            /*if the language is stored this means we have used
             *it in the past and thus the file is already loaded.
             */
           if(self::isSelectedLanguageStored(static::$language)) {
               return;
           }
            
            $path = $rootDirectory . 
                            DIRECTORY_SEPARATOR . Config::get()->I18n->path . 
                            DIRECTORY_SEPARATOR . static::$language;
                            
            self::loadFile($path);
         }
            
        private static function loadFile($path) {
            
            $format = Config::get()->I18n->format;
            
            $filePath = $path . '.' . $format;
            
            if($format == 'yaml') {
                self::$translations = YamlHandler::loadFile($filePath);
            }     
            elseif ($format == 'json') {
                self::$translations = JsonHandler::loadFile($filePath);
            }        
            
            if(!file_exists($filePath)) {
                 // write in the logger
            }
           
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
        
        private static function isSelectedLanguageStored($language) 
        {
            static::$selectedLanguages = Session::get('i18n.selectedLanguages', []);
            
            if(in_array($language, static::$selectedLanguages)) {
               return false;
            }
            
            array_push(static::$selectedLanguages, $language);
            Session::set('i18n.selectedLanguages', static::$selectedLanguages); 
               
            return true;
        }
        
    }

?>