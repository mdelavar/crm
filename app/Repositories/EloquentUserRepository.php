<?php

namespace App\Repositories;

use App\Contracts\EventRepository;
use App\Contracts\PositionRepository;
use App\Contracts\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{
    private string $defaultSort = '-id';

    private array $defaultSelect = [
        'id',
        'name',
        'email',
        'created_at',
        'updated_at',
    ];

    private array $allowedFilters = ["name"];

    private array $allowedSorts = [
        'updated_at',
        'created_at',
    ];

    private array $allowedIncludes = [
    ];

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }


    public function findByFilters(): LengthAwarePaginator
    {
        $perPage = (int)request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 20;

        return QueryBuilder::for($this->model)
            ->select($this->defaultSelect)
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->paginate($perPage);
    }


    /**
     * @return Collection|array
     */
    public function all(): Collection|array
    {
        return QueryBuilder::for($this->model)
            ->select($this->defaultSelect)
            ->get();
    }

    public function store(array $data): Model
    {
        $data["password"] = Hash::make($data["password"]);
        return parent::store($data);
    }

    public function update(Model $model, array $req): Model
    {
        $data = [];
        $data["name"] = $req["name"];
        $data["email"] = $req["email"];
        if ($req["password"]) {
            $data["password"] = Hash::make($req["password"]);
        }
        return parent::update($model , $data);
    }

}
