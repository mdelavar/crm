<?php

namespace App\Http\Controllers;

use App\Contracts\CreditRepository;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Resources\CreditCollection;
use App\Http\Resources\CreditResource;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CreditController extends Controller
{


    public function __construct(private CreditRepository $creditRepository)
    {
        $this->resourceItem = CreditResource::class;
        $this->resourceCollection = CreditCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'credits';
        $cacheKey = 'credits:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->creditRepository->findByFilters();
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
    public function store(StoreCreditRequest $request)
    {
        $data = $request->validated();
        $response = $this->creditRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credit $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCreditRequest $request, Credit $credit)
    {
        $data = $request->validated();
        $response = $this->creditRepository->update($credit, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credit $credit)
    {
        //
    }

    public function organizationCredits(Request $request)
    {
        $organizationId = $request->get('organization_id');
        if ($organizationId) {
            $response = $this->creditRepository->organizationCredits($request->get('organization_id'));
            return $this->respondWithCollection($response);
        } else {
            return [];
        }
    }
}
