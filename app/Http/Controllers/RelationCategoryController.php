<?php

namespace App\Http\Controllers;

use App\Contracts\RelationCategoryRepository;
use App\Http\Requests\StoreRelationCategoryRequest;
use App\Http\Resources\RelationCategoryCollection;
use App\Http\Resources\RelationCategoryResource;
use App\Models\RelationCategory;
use Illuminate\Support\Facades\Cache;

class RelationCategoryController extends Controller
{

    public function __construct(private RelationCategoryRepository $relationCategoryRepository)
    {
        $this->resourceItem = RelationCategoryResource::class;
        $this->resourceCollection = RelationCategoryCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'contacts';
        $cacheKey = 'contacts:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->relationCategoryRepository->findByFilters();
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
    public function store(StoreRelationCategoryRequest $request)
    {
        $data = $request->validated();
        $response = $this->relationCategoryRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(RelationCategory $relationCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RelationCategory $relationCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRelationCategoryRequest $request, RelationCategory $relationCategory)
    {
        $data = $request->validated();
        $response = $this->relationCategoryRepository->update($relationCategory, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RelationCategory $relationCategory)
    {
        //
    }
}
