<?php


namespace App\Repositories;


use App\Models\Todo;

class TodoRepository extends BaseRepository implements TodoRepositoryInterface
{
    public function __construct(Todo $model)
    {
        parent::__construct($model);
    }
}
