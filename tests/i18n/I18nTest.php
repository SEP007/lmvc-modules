<?php

use Scandio\lmvc\modules\i18n\I18nWrapper;
use Scandio\lmvc\modules\i18n\controllers\I18n;
use Scandio\lmvc\utils\config\Config;

class I18nTest extends PHPUnit_Framework_TestCase {
    
    private 
        $_rootPath = null;
        
    private static 
        $yaml = 'yaml',
        $json = 'json';
    
    protected function setUp() {
        $this->_rootPath = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        Config::initialize($this->_rootPath . 'config.json');
    }
    
    private function initialize($language, $fileFormat) 
    {
        Config::get()->I18n->default = $language;
        Config::get()->I18n->format = $fileFormat;
        I18nWrapper::loadFile($this->_rootPath);
    }
    
    public function testTranslateEnglishYaml()
    {
        $this->initialize('en', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('home'), 'Home');
    }
    
    public function testTranslateEnglishJson()
    {
        $this->initialize('en', self::$json);
        $this->assertEquals(I18nWrapper::translate('home'), 'Home');
    }
    
    public function testTranslateSwedishYaml()
    {
        $this->initialize('sv', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('home'), 'Hemma');
    }
    
    public function testTranslateSwedishJson()
    {
        $this->initialize('sv', self::$json);
        $this->assertEquals(I18nWrapper::translate('home'), 'Hemma');
    }
    
    public function testTranslateGermanYaml()
    {
        $this->initialize('de', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('home'), 'Start');
    }
    
    public function testTranslateGermanJson()
    {
        $this->initialize('de', self::$json);
        $this->assertEquals(I18nWrapper::translate('home'), 'Start');
    }
    
    public function testTranslateRussianYaml()
    {
        $this->initialize('ru', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('home'), 'Домой');
    }
    
    public function testTranslateRussianJson()
    {
        $this->initialize('ru', self::$json);
        $this->assertEquals(I18nWrapper::translate('home'), 'Домой');
    }
    
    public function testTranslateBulgarianYaml()
    {
        $this->initialize('bl', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('home'), 'Начало');
    }
    
    public function testTranslateBulgarianJson()
    {
        $this->initialize('bl', self::$json);
        $this->assertEquals(I18nWrapper::translate('home'), 'Начало');
    }
    
    public function testTranslateGreekYaml()
    {
        $this->initialize('el', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('home'), 'Αρχική Σελίδα');
    }
    
    public function testTranslateGreekJson()
    {
        $this->initialize('el', self::$json);
        $this->assertEquals(I18nWrapper::translate('home'), 'Αρχική Σελίδα');
    }
    
    public function testNonExistingKeyYaml() 
    {
        $this->initialize('en', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('nonExistingKey'), 'nonExistingKey');
    }
    
    public function testNonExistingKeyJson() 
    {
        $this->initialize('en', self::$json);
        $this->assertEquals(I18nWrapper::translate('nonExistingKey'), 'nonExistingKey');
    }
    
    public function testDoubleKeyYaml() 
    {
        /*
         * If a key exists, it will show the value of
         * the last key found in the file.
         */
        $this->initialize('en', self::$yaml);
        $this->assertEquals(I18nWrapper::translate('doubleKey'), 'Second occurrence of the key');
    }
    
    public function testDoubleKeyJson() 
    {
        /*
         * If a key exists, it will show the value of
         * the last key found in the file.
         */
        $this->initialize('en', self::$json);
        $this->assertEquals(I18nWrapper::translate('doubleKey'), 'Second occurrence of the key');
    }
    
    public function testNonExistingFile() 
    {
        $this->initialize('en', 'whatever');
        $this->assertEquals(I18nWrapper::translate('school'), 'school');
    }
    
}

?>