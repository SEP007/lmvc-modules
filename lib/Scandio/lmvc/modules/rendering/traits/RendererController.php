<?php

namespace Scandio\lmvc\modules\rendering\traits;

trait RendererController
{
    /**
     * Replaces the renderArg Array completely or merges it if
     * $add is set to true
     *
     * @static
     * @param array $renderArgs an associative array
     * @param bool $add optional set to true if you want to merge existing data with $renderArgs
     * @return void
     */
    public static function setRenderArgs($renderArgs, $add = false)
    {
        if (!is_null($renderArgs)) {
            self::$renderArgs = ($add) ? array_merge(self::$renderArgs, $renderArgs) : $renderArgs;
        }
    }

    /**
     * set a single render argument which is used
     * in render methods.
     *
     * @static
     * @param string $name name will be converted in $<name> in a view
     * @param mixed $value any kind of value.
     * @return void
     */
    public static function setRenderArg($name, $value)
    {
        static::$renderArgs[$name] = $value;
    }

    # Shorthand and compability fallback for renderEngine('php' ...)
    public static function render($renderArgs = array(), $template = null, $httpCode = 200, $masterTemplate = null)
    {
        static::setRenderArgs($renderArgs, true);

        static::renderEngine('php', static::$renderArgs, ['minor' => $template, 'major' => $masterTemplate], $httpCode);
    }

    # Shorthand and compability fallback for renderEngine('json' ...)
    public static function renderJson($renderArgs = null, $httpCode = 200, ArrayBuilderInterface $arrayBuilder = null)
    {
        static::setRenderArgs($renderArgs, true);

        static::renderEngine('json', static::$renderArgs, $httpCode, null);
    }

    # Shorthand and compability fallback for renderEngine('html' ...) - I guess you got it by now ;-)
    public static function renderHtml($html, $httpCode = 200)
    {
        static::renderEngine('html', $html, $httpCode);
    }

    # Shorthand and compability fallback for renderEngine('mustache' ...)
    public static function renderMustache($renderArgs, $httpCode = 200)
    {
        static::setRenderArgs($renderArgs, true);

        static::renderEngine('mustache', static::$renderArgs, $httpCode);
    }

    # Shorthand and compability fallback for renderEngine('smarty' ...)
    public static function renderSmarty($renderArgs, $httpCode = 200)
    {
        static::setRenderArgs($renderArgs, true);

        static::renderEngine('smarty', static::$renderArgs, $httpCode);
    }
}