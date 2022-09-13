<?php
namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUsers();

    public function getUserById(int $userId);

    public function store(array $data);

    public function delete(int $id);

    public function withPaginate(int $perPage, $filters);

    public function assignUserToGroup($userId, $groupIds);

    public function UnAssignUserToGroup($userId, $groupIds);
}
