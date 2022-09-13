<?php

namespace App\Services\Users;


use App\Models\User;
use App\Models\UserGroup;

class UnAssignUserFromGroupService
{
    public function UnAssignUserToGroup($userId, $groupIds)
    {
        $user = User::find($userId);
        $checkGroupAlreadyAssigned = UserGroup::where('user_id', $userId)->whereIn('group_id', $groupIds)->get();
        if ($checkGroupAlreadyAssigned->isNotEmpty()) {
            $user->groups()->detach($groupIds);
        }
        else{
            return false;
        }
        return $user;
    }
}
