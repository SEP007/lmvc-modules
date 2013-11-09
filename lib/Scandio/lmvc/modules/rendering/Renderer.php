<?php

namespace Scandio\lmvc\modules\rendering;

use Scandio\lmvc\utils\config\Config;

class Renderer
{
    protected static
      $renderers = [];

    public static function get($engine)
    {
        $engine = strtolower($engine);

        if ( !array_key_exists(static::$renderers[$engine]) ) {
            $class = Config::get()->rendering->additionals->{$engine};

            if (class_exists($class) && is_subclass_of($class, '\\Scandio\\lmvc\\modules\\rendering\\interfaces\\RendererInterface')) {
                static::$renderers[$engine] = new $class();
            } else {
                throw new \Exception('No valid renderer for given engine: ' . $engine . '!');
            }
        }

        return static::$renderers[$engine];
    }
}