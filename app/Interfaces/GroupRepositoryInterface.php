<?php

namespace App\Interfaces;

interface GroupRepositoryInterface
{
    public function groups();

    public function getGroupById(int $id);

    public function delete(int $id);

    public function store(array $data);

    public function withPaginate(int $perPage);

}
