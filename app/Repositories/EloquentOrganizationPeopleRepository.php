<?php

namespace App\Repositories;

use App\Contracts\CarServiceRepository;
use App\Contracts\OrganizationPeopleRepository;
use App\Contracts\OrganizationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentOrganizationPeopleRepository extends EloquentRepository implements OrganizationPeopleRepository
{
    private string $defaultSort = 'id';

    private array $defaultSelect = [
        'id',
        'name',
        'organization_id',
        'national_code',
        'phone',
        'car_number',
        'created_at',
        'updated_at',
    ];

    private array $allowedFilters = [
        'name',
        'national_code',
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
        $this->allowedFilters[] = AllowedFilter::exact('organization_id');
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
