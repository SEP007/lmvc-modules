<?php

namespace Scandio\lmvc\modules\security;

use Scandio\lmvc\Controller;
use Scandio\lmvc\utils\config\Config;
use Scandio\lmvc\modules\rendering\traits;

class AnonymousController extends Controller
{
    use traits\RendererController;

    /**
     * @var AbstractUser
     */
    protected static $currentUser;

    /**
     * @var string
     */
    protected static $controllerRole = 'anonymous';

    /**
     * @return bool
     */
    public static function preProcess()
    {
        if (!parent::preProcess()) {
            return false;
        }
        static::$currentUser = Security::get()->currentUser();
        return true;
    }

    public static function render($renderArgs = array(), $httpCode = 200, $template = null, $masterTemplate = null)
    {
        static::setRenderArg('currentUser', static::$currentUser);
        return static::renderEngine('php', $renderArgs, ['minor' => $template], $httpCode);
    }

    /**
     * @return bool
     */
    public static function forbidden()
    {
        $forbiddenAction = (isset(Config::get()->security->forbiddenAction)) ? Config::get()->security->forbiddenAction : 'Security::forbidden';
        static::redirect($forbiddenAction);
        return false;
    }
}