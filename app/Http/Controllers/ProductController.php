<?php

namespace App\Http\Controllers;

use App\Contracts\ProductCategoryRepository;
use App\Contracts\ProductRepository;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ImageHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ImageHandler;

    public function __construct(private ProductRepository $productRepository, private ProductCategoryRepository $productCategoryRepository)
    {
        $this->resourceItem = ProductResource::class;
        $this->resourceCollection = ProductCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'products';
        $cacheKey = 'products:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->productRepository->findByFilters();
            $categories = $this->productCategoryRepository->all();
            return $this->respondWithCollection($collection)->additional(compact("categories"));
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
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if (isset($data['pic'])) {
                $data['pic'] = "/uploads/" . $this->storeFile($request->file('pic'));
            }
            $response = $this->productRepository->store($data);
            DB::commit();
            return $this->respondWithItem($response);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            if (isset($data['pic'])) {
                $data['pic'] = "/uploads/" . $this->storeFile($request->file('pic'));
            }
            $response = $this->productRepository->update($product, $data);
            DB::commit();
            return $this->respondWithItem($response);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
