<?php

namespace App\Repositories;

use App\Contracts\OrganizationRepository;
use App\Contracts\PersonUseCreditRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentPersonUseCreditRepository extends EloquentRepository implements PersonUseCreditRepository
{
    private string $defaultSort = 'id';

    private array $defaultSelect = [
        'id',
        'organization_people_id',
        'amount',
        'car_service_id',
        'service_id',
        'created_at',
        'updated_at',
    ];

    private array $allowedFilters = [
        'organization_people.name',
        'organization_people.organization.name',
        'car_service.name',
        'service.name',
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
        $this->allowedFilters[] = AllowedFilter::exact('organization_people_id');
        $this->allowedFilters[] = AllowedFilter::exact('car_service_id');
        $this->allowedFilters[] = AllowedFilter::exact('service_id');
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
