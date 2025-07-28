<?php

namespace App\Http\Controllers;

use App\Contracts\ServicesRepository;
use App\Http\Resources\ServicesCollection;
use App\Http\Resources\ServicesResource;
use App\Models\Services;
use App\Http\Requests\StoreServicesRequest;
use Illuminate\Support\Facades\Cache;

class ServicesController extends Controller
{

    public function __construct(private ServicesRepository $servicesRepository)
    {
        $this->resourceItem = ServicesResource::class;
        $this->resourceCollection = ServicesCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'services';
        $cacheKey = 'services:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->servicesRepository->findByFilters();
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
    public function store(StoreServicesRequest $request)
    {
        $data = $request->validated();
        $response = $this->servicesRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreServicesRequest $request, Services $services)
    {
        $data = $request->validated();
        $response = $this->servicesRepository->update($services, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Services $services)
    {
        //
    }
}
