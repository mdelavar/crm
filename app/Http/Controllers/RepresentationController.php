<?php

namespace App\Http\Controllers;

use App\Contracts\RepresentationRepository;
use App\Http\Requests\StoreRepresentationRequest;
use App\Http\Resources\RepresentationCollection;
use App\Http\Resources\RepresentationResource;
use App\Models\Representation;
use Illuminate\Support\Facades\Cache;

class RepresentationController extends Controller
{
    public function __construct(private RepresentationRepository $representationRepository)
    {
        $this->resourceItem = RepresentationResource::class;
        $this->resourceCollection = RepresentationCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'representations';
        $cacheKey = 'representations:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->representationRepository->findByFilters();
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
    public function store(StoreRepresentationRequest $request)
    {
        $data = $request->validated();
        $response = $this->representationRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Representation $representation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Representation $representation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRepresentationRequest $request, Representation $representation)
    {
        $data = $request->validated();
        $response = $this->representationRepository->update($representation, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Representation $representation)
    {
        //
    }
}
