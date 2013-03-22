<?php

namespace Scandio\lmvc\modules\mustache;

class Mustache {

    public static function renderString($templateString, $data=array()) {
        $mustache = new Mustache_Engine();
        return $mustache->render($templateString, $data);
    }

    public static function render($template, $data=array()) {
        return self::renderString(self::getTemplate($template), $data);
    }

    public static function get($template) {
        return self::getTemplate($template);
    }

    private static function getTemplate($template) {
        return file_get_contents('./templates/' . $template . '.mustache');
    }
}