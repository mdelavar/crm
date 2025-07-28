<?php

namespace App\Repositories;

use App\Contracts\CarServiceRepository;
use App\Contracts\CreditRepository;
use App\Contracts\OrganizationRepository;
use App\Models\OrganizationPerson;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class EloquentCreditRepository extends EloquentRepository implements CreditRepository
{
    private string $defaultSort = 'id';

    private array $defaultSelect = [
        'id',
        'organization_people_id',
        'amount',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    private array $allowedFilters = [];

    private array $allowedSorts = [];

    private array $allowedIncludes = [
        'person'
    ];

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        parent::__construct($model);
        $this->allowedFilters[] = "organization_people_id";
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

    public function organizationCredits($organization_id) : LengthAwarePaginator
    {

        $perPage = (int)request()->get('limit');
        $perPage = $perPage >= 1 && $perPage <= 100 ? $perPage : 20;

        return QueryBuilder::for($this->model)
            ->select($this->defaultSelect)
            ->whereIn('organization_people_id', OrganizationPerson::query()->where('organization_id', $organization_id)->pluck('id'))
            ->allowedFilters($this->allowedFilters)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort)
            ->paginate($perPage);
    }
}
