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
        self::$renderArgs[$name] = $value;
    }

    public static function render($renderArgs = array(), $template = null, $httpCode = 200, $masterTemplate = null)
    {
        static::renderEngine('php', $renderArgs, ['minor' => $template, 'major' => $masterTemplate], $httpCode);
    }

    public static function renderJson($renderArgs = null, $httpCode = 200, ArrayBuilderInterface $arrayBuilder = null)
    {
        static::renderEngine('json', $renderArgs, $httpCode, null);
    }

    public static function renderHtml($html, $httpCode = 200)
    {
        static::renderEngine('html', $html, $httpCode);
    }
}