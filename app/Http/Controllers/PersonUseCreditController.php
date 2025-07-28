<?php

namespace App\Http\Controllers;

use App\Models\PersonUseCredit;
use App\Http\Requests\StorePersonUseCreditRequest;
use App\Http\Requests\UpdatePersonUseCreditRequest;
use Illuminate\Http\Request;

class PersonUseCreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePersonUseCreditRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonUseCredit $personUseCredit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonUseCredit $personUseCredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonUseCreditRequest $request, PersonUseCredit $personUseCredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonUseCredit $personUseCredit)
    {
        //
    }

    public function submitService(Request $request)
    {
        $data = request()->validate([
           'person' => 'required|exists:organization_people,id',
           'car_service' => 'required|exists:car_services,id',
           'services' => 'required|array',
           'services.*.id' => 'required|exists:services,id',
           'services.*.amount' => 'required|integer|min:1',
        ]);

        foreach ($data['services'] as $service) {
            PersonUseCredit::query()->create([
                'organization_people_id' => $data['person'],
                'car_service_id' => $data['car_service'],
                'service_id' => $service['id'],
                'amount' => $service['amount'],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
