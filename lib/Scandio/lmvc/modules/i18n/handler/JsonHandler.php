<?php
    namespace Scandio\lmvc\modules\i18n\handler;
    
    use Scandio\lmvc\modules\assetpipeline\util\AssetPipelineHelper;

    
    class JsonHandler {
        
        private static $helper;
        
        private static function initHelper() 
        {
            if(is_null(static::$helper)) {
                static::$helper = new AssetPipelineHelper();
            }
        }
        
        public static function loadFile($filePath) 
        {
            self::initHelper();
            return static::$helper->asArray(
                            json_decode(
                                file_get_contents($filePath)));
        }
        
    }
?>