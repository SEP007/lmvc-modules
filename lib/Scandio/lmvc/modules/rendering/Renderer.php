<?php

namespace Scandio\lmvc\modules\rendering;

use Scandio\lmvc\utils\config\Config;

/**
 * Class Renderer
 * @package Scandio\lmvc\modules\rendering
 *
 * Factory returning and caching specific renderers. Request a renderer by its handle and specify the handler's
 * namespace in the app's config.json.
 */
class Renderer
{
    protected static
      $renderers = [];

    /**
     * @param string $engine requested to render templates, files or data-structures
     *
     * @return RendererInterface instance of this type e.g. HtmlHandler
     *
     * @throws \Exception if renderer not configured in config or not implementing RendererInterface
     */
    public static function get($engine)
    {
        # Safety first
        $engine = strtolower($engine);

        # If renderer not instanciated and cached yet
        if ( !array_key_exists($engine, static::$renderers) ) {
            # Get the configuration of requested renderer
            $config = Config::get()->rendering->handlers->{$engine};
            $class  = $config->namespace;

            # Check if class exists and object would be correct implementation of RendererInterface
            if (class_exists($class) && is_subclass_of($class, '\\Scandio\\lmvc\\modules\\rendering\\interfaces\\RendererInterface')) {
                # Create and initialize the renderer
                $renderer = new $class();
                $renderer->initialize($config);

                # Set it on cache
                static::$renderers[$engine] = $renderer;
            } else {
                # Stuff went wrong (gotta love bad docs)
                throw new \Exception('No valid renderer for given engine: ' . $engine . '!');
            }
        }

        # Return the requested renderer
        return static::$renderers[$engine];
    }
}