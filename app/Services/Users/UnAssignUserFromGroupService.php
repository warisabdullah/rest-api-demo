<?php

namespace App\Services\Users;


use App\Models\User;
use App\Models\UserGroup;

class UnAssignUserFromGroupService
{
    public function UnAssignUserToGroup($userId, $groupId)
    {
        $user = User::find($userId);
        $checkGroupAlreadyAssigned = UserGroup::where('user_id', $userId)->where('group_id', $groupId)->first();
        if ($checkGroupAlreadyAssigned) {
            $user->groups()->detach($groupId);
        }
        else{
            return false;
        }
        return $user;
    }
}
