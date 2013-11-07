<?php

namespace Scandio\lmvc\modules\session;

use Scandio\lmvc\LVC;

class Bootstrap extends \Scandio\lmvc\utils\bootstrap\Bootstrap
{
    public function initialize()
    {
        Session::start();
    }
}