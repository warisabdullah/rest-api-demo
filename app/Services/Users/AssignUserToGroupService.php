<?php

namespace App\Services\Users;


use App\Models\User;
use App\Models\UserGroup;

class AssignUserToGroupService
{
    public function assignUserToGroup($userId, $groupId)
    {
        $user = User::find($userId);
        $checkGroupAlreadyAssigned = UserGroup::where('user_id', $userId)->where('group_id', $groupId)->first();
        if ($checkGroupAlreadyAssigned) {
            return false;
        }
        else{
            $user->groups()->attach($groupId);
        }
        return $user;
    }
}
