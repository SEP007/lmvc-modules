<?php

namespace Scandio\lmvc\modules\rendering\interfaces;

/**
 * Interface AssetPipeInterface
 * @package Scandio\lmvc\modules\rendering\interfaces
 */
interface RendererInterface
{
    public function setRenderArgs($renderArgs, $merge = false);
    public function render($renderArgs = [], $template = null);
    public function getExtention();
}