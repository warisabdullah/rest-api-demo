<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Services\Users\AssignUserToGroupService;
use App\Services\Users\CreateUserService;
use App\Services\Users\DeleteUserService;
use App\Services\Users\UnAssignUserFromGroupService;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    private $createUserService;
    private $deleteUserService;
    private $assignUserToGroupService;
    private $unAssignUserToGroupService;

    public function __construct(
        CreateUserService            $createUserService,
        DeleteUserService            $deleteUserService,
        AssignUserToGroupService     $assignUserToGroupService,
        UnAssignUserFromGroupService $unAssignUserToGroupService
    )
    {
        $this->createUserService = $createUserService;
        $this->deleteUserService = $deleteUserService;
        $this->assignUserToGroupService = $assignUserToGroupService;
        $this->unAssignUserToGroupService = $unAssignUserToGroupService;
    }

    /**
     * @return Collection
     */
    public function getUsers(): Collection
    {
        return User::all();
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId): User
    {
        return User::find($userId);
    }

    public function withPaginate($perPage, $filters = null)
    {
        $firstName = $filters->first_name;
        $groupName = $filters->group_name;

        $sortByFirstName = $filters->sort_by_first_name;
        $sortByLastName = $filters->sort_by_last_name;
        $sortByGroupCount = $filters->sort_by_group_count;


        $users = User::withCount(['groups'])->with('groups');
        if ($firstName) {
            $users->where('first_name', $firstName);
        }
        if ($groupName) {
            $users->whereHas('groups', function ($q) use ($groupName) {
                if ($groupName) {
                    $q->where('name', $groupName);
                }
            });
        }

        if ($sortByFirstName) {
            $users->orderBy('first_name', $sortByFirstName);
        }
        if ($sortByLastName) {
            $users->orderBy('last_name', $sortByLastName);
        }
        if ($sortByGroupCount) {
            $users->orderBy('groups_count', $sortByGroupCount);
        }
        return $users->paginate($perPage);
    }

    public function store($data)
    {
        return $this->createUserService->createUser($data);
    }

    public function delete($id)
    {
        return $this->deleteUserService->deleteUser($id);

    }

    public function assignUserToGroup($userId, $groupIds)
    {
        return $this->assignUserToGroupService->assignUserToGroup($userId, $groupIds);
    }

    public function UnAssignUserToGroup($userId, $groupIds)
    {
        return $this->unAssignUserToGroupService->UnAssignUserToGroup($userId, $groupIds);
    }
}
