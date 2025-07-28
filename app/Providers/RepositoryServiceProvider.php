<?php

namespace App\Providers;

use App\Contracts\BoxRepository;
use App\Contracts\CarServiceRepository;
use App\Contracts\ContactRepository;
use App\Contracts\CreditRepository;
use App\Contracts\OrganizationPeopleRepository;
use App\Contracts\OrganizationRepository;
use App\Contracts\ProductCategoryRepository;
use App\Contracts\ProductRepository;
use App\Contracts\ProductSerialNumberRepository;
use App\Contracts\RelationCategoryRepository;
use App\Contracts\RelationRepository;
use App\Contracts\RepresentationRepository;
use App\Contracts\ServicesRepository;
use App\Contracts\UserRepository;
use App\Models\Box;
use App\Models\CarService;
use App\Models\Contact;
use App\Models\Credit;
use App\Models\Organization;
use App\Models\OrganizationPerson;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSerialNumber;
use App\Models\Relation;
use App\Models\RelationCategory;
use App\Models\Representation;
use App\Models\Services;
use App\Models\User;
use App\Repositories\EloquentBoxRepository;
use App\Repositories\EloquentCarServiceRepository;
use App\Repositories\EloquentContactRepository;
use App\Repositories\EloquentCreditRepository;
use App\Repositories\EloquentOrganizationPeopleRepository;
use App\Repositories\EloquentOrganizationRepository;
use App\Repositories\EloquentProductCategoryRepository;
use App\Repositories\EloquentProductRepository;
use App\Repositories\EloquentProductSerialNumberRepository;
use App\Repositories\EloquentRelationCategoryRepository;
use App\Repositories\EloquentRelationRepository;
use App\Repositories\EloquentRepresentationRepository;
use App\Repositories\EloquentServicesRepository;
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
        $this->app->singleton(RepresentationRepository::class, function () {
            return new EloquentRepresentationRepository(new Representation());
        });
        $this->app->singleton(BoxRepository::class, function () {
            return new EloquentBoxRepository(new Box());
        });
        $this->app->singleton(OrganizationRepository::class, function () {
            return new EloquentOrganizationRepository(new Organization());
        });
        $this->app->singleton(CarServiceRepository::class, function () {
            return new EloquentCarServiceRepository(new CarService());
        });
        $this->app->singleton(OrganizationPeopleRepository::class, function () {
            return new EloquentOrganizationPeopleRepository(new OrganizationPerson());
        });
        $this->app->singleton(CreditRepository::class, function () {
            return new EloquentCreditRepository(new Credit());
        });
        $this->app->singleton(ServicesRepository::class, function () {
            return new EloquentServicesRepository(new Services());
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
            RepresentationRepository ::class,
            BoxRepository ::class,
            OrganizationRepository ::class,
            CarServiceRepository ::class,
            OrganizationPeopleRepository ::class,
            CreditRepository ::class,
            ServicesRepository ::class,
        ];
    }
}
