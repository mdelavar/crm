<?php

namespace App\Repositories;

use App\Contracts\OrganizationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentOrganizationRepository extends EloquentRepository implements OrganizationRepository
{
    private string $defaultSort = 'id';

    private array $defaultSelect = [
        'id',
        'name',
        'phone',
        'password',
        'created_at',
        'updated_at',
    ];

    private array $allowedFilters = [
        'name',
        'phone',
    ];

    private array $allowedSorts = [];

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
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)->get();
    }
}
