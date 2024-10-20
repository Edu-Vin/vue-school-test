<?php

namespace App\Contracts\Users;

interface UserInterface {

    public function updateUsersWithRandomInfo() : void;

    public function updateProviderWithUserInfo() : void;
}