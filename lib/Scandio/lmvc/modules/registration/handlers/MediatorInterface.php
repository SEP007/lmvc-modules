<?php

namespace Scandio\lmvc\modules\registration\handlers;

interface MediatorInterface
{
    public function arePossibleCredentials($username, $password);
    public function isValidPassword($password, $passwordRetyped);
    public function signup($credentials);
    public function getSignedUpUser();
    public function getUserById($id);
    public function edit($credentials);
}