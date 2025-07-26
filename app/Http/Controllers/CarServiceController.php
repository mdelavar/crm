<?php

namespace App\Http\Controllers;

use App\Contracts\CarServiceRepository;
use App\Http\Requests\StoreCarServiceRequest;
use App\Http\Resources\CarServiceCollection;
use App\Http\Resources\CarServiceResource;
use App\Models\CarService;
use Illuminate\Support\Facades\Cache;

class CarServiceController extends Controller
{

    public function __construct(private CarServiceRepository $carServiceRepository)
    {
        $this->resourceItem = CarServiceResource::class;
        $this->resourceCollection = CarServiceCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'car_services';
        $cacheKey = 'car_services:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->carServiceRepository->findByFilters();
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
    public function store(StoreCarServiceRequest $request)
    {
        $data = $request->validated();
        $response = $this->carServiceRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarService $carService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarService $carService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCarServiceRequest $request, CarService $carService)
    {
        $data = $request->validated();
        $response = $this->carServiceRepository->update($carService, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarService $carService)
    {
        //
    }
}
