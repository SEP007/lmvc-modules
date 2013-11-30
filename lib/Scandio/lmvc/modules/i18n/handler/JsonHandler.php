<?php
    namespace Scandio\lmvc\modules\i18n\handler;
    
    class JsonHandler {
        
        public static function loadFile($filePath) 
        {
            return json_decode(file_get_contents($filePath), true);
        }
        
    }
?>