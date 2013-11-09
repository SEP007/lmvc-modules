<?php

namespace Scandio\lmvc\modules\rendering\interfaces;

/**
 * Interface AssetPipeInterface
 * @package Scandio\lmvc\modules\rendering\interfaces
 */
interface RendererInterface
{
    public static function setRenderArgs($renderArgs);
    public static function render($template);
}