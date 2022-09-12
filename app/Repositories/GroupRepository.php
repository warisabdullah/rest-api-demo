<?php

namespace App\Repositories;

use App\Interfaces\GroupRepositoryInterface;
use App\Models\Group;
use App\Services\Group\CreateGroupService;
use App\Services\Group\DeleteGroupService;
use Illuminate\Database\Eloquent\Collection;

class GroupRepository implements GroupRepositoryInterface
{
    private $createGroupService;
    private $deleteGroupService;

    public function __construct(CreateGroupService $createGroupService, DeleteGroupService $deleteGroupService)
    {
        $this->createGroupService = $createGroupService;
        $this->deleteGroupService = $deleteGroupService;
    }

    /**
     * @return Collection
     */
    public function groups(): Collection
    {
        return Group::all();
    }

    /**
     * @param int $userId
     * @return Group
     */
    public function getGroupById(int $userId): Group
    {
        return Group::find($userId);
    }

    public function withPaginate($perPage)
    {
        return Group::with('users')->paginate($perPage);
    }

    public function delete(int $id)
    {
        return $this->deleteGroupService->deleteGroup($id);
    }

    public function store(array $data)
    {
        return $this->createGroupService->createGroup($data);
    }
}
