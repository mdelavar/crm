<?php

namespace App\Repositories;

use App\Contracts\ContactRepository;
use App\Contracts\RelationCategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class EloquentRelationCategoryRepository extends EloquentRepository implements RelationCategoryRepository
{
    private string $defaultSort = 'id';

    private array $defaultSelect = [
        'id',
        'title',
        'created_at',
        'updated_at',
        'created_by',
        'changed_by',
    ];

    private array $allowedFilters = [
        'title',
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
