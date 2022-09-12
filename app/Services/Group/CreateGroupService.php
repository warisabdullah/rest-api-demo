<?php

namespace App\Services\Group;

use App\Models\Group;

class CreateGroupService
{
    public function createGroup($group)
    {
        return Group::create([
            'name' => $group['name'],
        ]);
    }
}
