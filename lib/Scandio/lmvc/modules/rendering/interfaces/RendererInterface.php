<?php

namespace Scandio\lmvc\modules\rendering\interfaces;

/**
 * Interface AssetPipeInterface
 * @package Scandio\lmvc\modules\rendering\interfaces
 */
interface RendererInterface
{
    public function setRenderArgs($renderArgs);
    public function render($template = null);
}