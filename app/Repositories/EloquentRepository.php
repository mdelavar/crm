<?php

namespace App\Repositories;

use App\Contracts\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository implements BaseRepository
{
    protected Model $model;

    protected bool $withoutGlobalScopes = false;

    protected array $with = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function with(array $with = []): BaseRepository
    {
        $this->with = $with;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function withoutGlobalScopes(): BaseRepository
    {
        $this->withoutGlobalScopes = true;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * {@inheritdoc}
     */
    public function update(Model $model, array $data): Model
    {
        return tap($model)->update($data);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Model $model): Model
    {
        return tap($model)->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function forceDelete(Model $model): Model
    {
        return tap($model)->forceDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function destroy(int $id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * {@inheritdoc}
     */
    public function forceDestroy(int $id): int
    {
        return $this->model->newQuery()
            ->where('id', '=', $id)
            ->forceDelete();
    }

    /**
     * @param array $ids
     * @return int
     */
    public function destroyMany(array $ids): int
    {
        return $this->model->destroy($ids);
    }

    /**
     * @param array $ids
     * @return int
     */
    public function forceDestroyMany(array $ids): int
    {
        return $this->model->newQuery()
            ->whereIn('id', $ids)
            ->forceDelete();
    }

    /**
     * {@inheritdoc}
     */
    public function findByFilters(): LengthAwarePaginator
    {
        return $this->model->with($this->with)->paginate();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneById(string $id): Model
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBy(array $criteria): Model
    {
        if (!$this->withoutGlobalScopes) {
            return $this->model->with($this->with)
                ->where($criteria)
                ->orderByDesc('created_at')
                ->firstOrFail();
        }

        return $this->model->with($this->with)
            ->withoutGlobalScopes()
            ->where($criteria)
            ->orderByDesc('created_at')
            ->firstOrFail();
    }


    /**
     * @param Model $model
     * @return string
     */
    protected static function getClassName(Model $model): string
    {
        return basename(str_replace('\\', '/', strtolower(get_class($model))));
    }
}
