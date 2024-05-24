<?php

namespace App\Providers;

use App\Contracts\ContactRepository;
use App\Contracts\ProductCategoryRepository;
use App\Contracts\ProductRepository;
use App\Contracts\ProductSerialNumberRepository;
use App\Contracts\RelationCategoryRepository;
use App\Contracts\RelationRepository;
use App\Contracts\UserRepository;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSerialNumber;
use App\Models\Relation;
use App\Models\RelationCategory;
use App\Models\User;
use App\Repositories\EloquentContactRepository;
use App\Repositories\EloquentProductCategoryRepository;
use App\Repositories\EloquentProductRepository;
use App\Repositories\EloquentProductSerialNumberRepository;
use App\Repositories\EloquentRelationCategoryRepository;
use App\Repositories\EloquentRelationRepository;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     */
    protected bool $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(UserRepository::class, function () {
            return new EloquentUserRepository(new User());
        });
        $this->app->singleton(ContactRepository::class, function () {
            return new EloquentContactRepository(new Contact());
        });
        $this->app->singleton(RelationCategoryRepository::class, function () {
            return new EloquentRelationCategoryRepository(new RelationCategory());
        });
        $this->app->singleton(RelationRepository::class, function () {
            return new EloquentRelationRepository(new Relation());
        });
        $this->app->singleton(ProductCategoryRepository::class, function () {
            return new EloquentProductCategoryRepository(new ProductCategory());
        });
        $this->app->singleton(ProductRepository::class, function () {
            return new EloquentProductRepository(new Product());
        });
        $this->app->singleton(ProductSerialNumberRepository::class, function () {
            return new EloquentProductSerialNumberRepository(new ProductSerialNumber());
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            UserRepository::class,
            ContactRepository::class,
            RelationCategoryRepository::class,
            RelationRepository::class,
            ProductCategoryRepository::class,
            ProductRepository::class,
            ProductSerialNumberRepository::class,
        ];
    }
}
