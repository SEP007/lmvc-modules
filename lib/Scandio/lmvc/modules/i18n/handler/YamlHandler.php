<?php
    namespace Scandio\lmvc\modules\i18n\handler;

    use spyc\Spyc;
    
    class YamlHandler {
        
        public static function loadFile($filePath) {
            return spyc_load_file($filePath);
        }
        
    }
?>