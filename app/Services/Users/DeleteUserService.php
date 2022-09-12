<?php

namespace App\Services\Users;


use App\Models\User;

class DeleteUserService
{
    public function deleteUser($id)
    {
        return User::where('id', $id)->delete();
    }
}
