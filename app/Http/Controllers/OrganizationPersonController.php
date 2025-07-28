<?php

namespace App\Http\Controllers;

use App\Contracts\OrganizationPeopleRepository;
use App\Http\Resources\OrganizationPeopleCollection;
use App\Http\Resources\OrganizationPeopleResource;
use App\Models\OrganizationPerson;
use App\Http\Requests\StoreOrganizationPersonRequest;
use App\Http\Requests\UpdateOrganizationPersonRequest;
use App\Models\Services;
use App\Rules\NationalCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OrganizationPersonController extends Controller
{

    public function __construct(private OrganizationPeopleRepository $organizationPeopleRepository)
    {
        $this->resourceItem = OrganizationPeopleResource::class;
        $this->resourceCollection = OrganizationPeopleCollection::class;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $cacheTag = 'organizationPeople';
        $cacheKey = 'organizationPeople:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->organizationPeopleRepository->findByFilters();
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
    public function store(StoreOrganizationPersonRequest $request)
    {
        $data = $request->validated();
        $response = $this->organizationPeopleRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrganizationPerson $organizationPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrganizationPerson $organizationPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrganizationPersonRequest $request, OrganizationPerson $organizationPerson)
    {
        $data = $request->validated();
        $response = $this->organizationPeopleRepository->update($organizationPerson, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrganizationPerson $organizationPerson)
    {
        //
    }

    public function checkNational(Request $request)
    {
        $data = $request->validate([
            'national_code' => ['required', new NationalCode()],
        ]);

        $organizationPerson = OrganizationPerson::query()->where('national_code', $data['national_code'])->first();
        if ($organizationPerson) {
            return ['person' => $this->respondWithItem($organizationPerson) , 'organization' => $organizationPerson->organization , 'credit' => $organizationPerson->remindCredit() , 'services' => Services::all()];
        } else {
            return response()->json(["errors" => ['فرد مورد نظر یافت نشد!']], 422);
        }
    }
}
