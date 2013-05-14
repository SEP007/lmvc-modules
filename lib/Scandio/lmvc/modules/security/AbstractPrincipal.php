<?php

namespace Scandio\lmvc\modules\security;

abstract class AbstractPrincipal implements PrincipalInterface
{
    /**
     * @var string
     */
    protected $userClass;

    /**
     * @param string $userClass
     */
    public function __construct($userClass)
    {
        if ($userClass && is_subclass_of($userClass, '\\Scandio\\lmvc\\modules\\security\\UserInterface')) {
            $this->userClass = $userClass;
        } else {
            $this->userClass = Bootstrap::getNamespace() . '\\User';
        }
    }

    /**
     * @return string[]
     */
    public function getCurrentUserGroups() {
        return $this->getUserGroups($this->currentUser()->username);
    }

    /**
     * @return string[]
     */
    public function getCurrentUserRoles() {
        return $this->getUserRoles($this->currentUser()->username);
    }
}