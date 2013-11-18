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
            $translations = array();
        
        public static function loadFile($rootDirectory) {
            static::$language = Session::get('i18n.language', Config::get()->I18n->default);
       
            $path = $rootDirectory . 
                            DIRECTORY_SEPARATOR . Config::get()->I18n->path . 
                            DIRECTORY_SEPARATOR . static::$language;
            
            
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
        
    }

?>