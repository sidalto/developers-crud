<?php

namespace App\Repository;

use App\Models\Developer;

class DeveloperRepository implements DeveloperRepositoryInterface
{
    private $model;

    public function __construct(Developer $model)
    {
        $this->model = $model;
    }

    public function listAll(): iterable
    {
        return $this->model->paginate();
    }

    public function listByQuery(string $param, string $value): iterable
    {
        return $this->model::where($param, 'like', $value . '%')->paginate();
    }

    public function create(array $data): Developer
    {
        return Developer::create($data);
    }

    public function show(int $id): Developer
    {
        return Developer::findOrFail($id);
    }

    public function delete(int $id)
    {
        $developer = Developer::findOrFail($id);

        $developer->delete();
    }

    public function update(int $id, array $data): Developer
    {
        $currentDeveloper = Developer::findOrFail($id);

        return $currentDeveloper->update($data);
    }
}
