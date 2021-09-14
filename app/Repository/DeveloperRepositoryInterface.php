<?php

namespace App\Repository;

use App\Models\Developer;

interface DeveloperRepositoryInterface
{
    public function listAll(): iterable;
    public function listByQuery(string $param, string $value): iterable;
    public function create(array $data): Developer;
    public function show(int $id): Developer;
    public function update(int $id, array $data): Developer;
    public function delete(int $id);
}
