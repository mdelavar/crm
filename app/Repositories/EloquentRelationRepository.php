<?php

namespace App\Repositories;

use App\Contracts\ContactRepository;
use App\Contracts\RelationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class EloquentRelationRepository extends EloquentRepository implements RelationRepository
{
    private string $defaultSort = 'id';

    private array $defaultSelect = [
        'id',
        'contact_id',
        'by_user',
        'relation_category_id',
        'title',
        'call_time',
        'call_result',
        'next_call_time',
        'created_at',
        'updated_at',
        'created_by',
        'changed_by',
    ];

    private array $allowedFilters = [
        'name',
        'mobile',
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
