<?php

namespace App\Http\Controllers;

use App\Contracts\ContactRepository;
use App\Contracts\RelationCategoryRepository;
use App\Contracts\RelationRepository;
use App\Http\Resources\RelationCollection;
use App\Http\Resources\RelationResource;
use App\Models\Relation;
use App\Http\Requests\StoreRelationRequest;
use App\Http\Requests\UpdateRelationRequest;
use Illuminate\Support\Facades\Cache;

class RelationController extends Controller
{

    public function __construct(private RelationRepository $relationRepository , private RelationCategoryRepository $relationCategoryRepository, private  ContactRepository $contactRepository)
    {
        $this->resourceItem = RelationResource::class;
        $this->resourceCollection = RelationCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'relations';
        $cacheKey = 'relations:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->relationRepository->findByFilters();
            $contacts = $this->contactRepository->all();
            $categories = $this->relationCategoryRepository->all();
            return $this->respondWithCollection($collection)->additional(compact('contacts' , 'categories'));
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
    public function store(StoreRelationRequest $request)
    {
        $data = $request->validated();
        $response = $this->relationRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Relation $relation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Relation $relation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRelationRequest $request, Relation $relation)
    {
        $data = $request->validated();
        $response = $this->relationRepository->update($relation, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Relation $relation)
    {
        //
    }
}
