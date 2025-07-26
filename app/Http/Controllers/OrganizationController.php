<?php

namespace App\Http\Controllers;

use App\Contracts\OrganizationRepository;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Support\Facades\Cache;

class OrganizationController extends Controller
{

    public function __construct(private OrganizationRepository $organizationRepository)
    {
        $this->resourceItem = OrganizationResource::class;
        $this->resourceCollection = OrganizationCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'organizations';
        $cacheKey = 'organizations:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->organizationRepository->findByFilters();
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
    public function store(StoreOrganizationRequest $request)
    {
        $data = $request->validated();
        $response = $this->organizationRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrganizationRequest $request, Organization $organization)
    {
        $data = $request->validated();
        $response = $this->organizationRepository->update($organization, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        //
    }
}
