<?php

namespace App\Http\Controllers;

use App\Contracts\ProductCategoryRepository;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Resources\ProductCategoryCollection;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;

class ProductCategoryController extends Controller
{

    public function __construct(private ProductCategoryRepository $productCategoryRepository)
    {
        $this->resourceItem = ProductCategoryResource::class;
        $this->resourceCollection = ProductCategoryCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'p_categories';
        $cacheKey = 'p_categories:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->productCategoryRepository->findByFilters();
            return $this->respondWithCollection($collection);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCategoryRequest $request)
    {
        $data = $request->validated();
        $response = $this->productCategoryRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $data = $request->validated();
        $response = $this->productCategoryRepository->update($productCategory, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }
}
