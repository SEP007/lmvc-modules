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

        if ( !array_key_exists($engine, static::$renderers) ) {
            $config = Config::get()->rendering->additionals->{$engine};
            $class  = $config->namespace;

            if (class_exists($class) && is_subclass_of($class, '\\Scandio\\lmvc\\modules\\rendering\\interfaces\\RendererInterface')) {
                $renderer = new $class();
                $renderer->initialize($config);

                static::$renderers[$engine] = $renderer;
            } else {
                throw new \Exception('No valid renderer for given engine: ' . $engine . '!');
            }
        }

        return static::$renderers[$engine];
    }
}