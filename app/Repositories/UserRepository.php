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
        CreateUserService        $createUserService,
        DeleteUserService        $deleteUserService,
        AssignUserToGroupService $assignUserToGroupService,
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

    public function withPaginate($perPage)
    {
        return User::paginate($perPage);
    }

    public function store($data)
    {
        return $this->createUserService->createUser($data);
    }

    public function delete($id)
    {
        return $this->deleteUserService->deleteUser($id);

    }

    public function assignUserToGroup($userId, $groupId)
    {
        return $this->assignUserToGroupService->assignUserToGroup($userId, $groupId);
    }

    public function UnAssignUserToGroup($userId, $groupId)
    {
        return $this->unAssignUserToGroupService->UnAssignUserToGroup($userId, $groupId);
    }
}
