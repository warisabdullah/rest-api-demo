<?php

namespace App\Services\Users;


use App\Models\User;

class CreateUserService
{
    public function createUser($user)
    {
        return User::create([
           'first_name' => $user['first_name'],
           'last_name' => $user['last_name'],
           'email' => $user['email'],
           'description' => $user['description'],
        ]);
    }
}
