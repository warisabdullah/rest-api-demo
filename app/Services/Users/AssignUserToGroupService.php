<?php

namespace App\Services\Users;


use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use App\Models\UserGroup;

class AssignUserToGroupService
{
    public function assignUserToGroup($userId, $groupIds)
    {
        $user = User::find($userId);
        $checkGroupAlreadyAssigned = UserGroup::where('user_id', $userId)->whereIn('group_id', $groupIds)->get();
        if ($checkGroupAlreadyAssigned->isNotEmpty()) {
            return false;
        }
        else{
            $user->groups()->attach($groupIds);
            SendWelcomeEmail::dispatch($user);
        }
        return $user;
    }
}
