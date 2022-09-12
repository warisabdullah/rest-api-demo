<?php

namespace App\Services\Group;

use App\Models\Group;

class DeleteGroupService
{
    public function deleteGroup($id)
    {
        return Group::where('id', $id)->delete();
    }
}
