<?php

namespace App\Http\Controllers;

use App\Models\PersonService;
use App\Http\Requests\StorePersonServiceRequest;
use App\Http\Requests\UpdatePersonServiceRequest;

class PersonServiceController extends Controller
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
    public function store(StorePersonServiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonService $personService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonService $personService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonServiceRequest $request, PersonService $personService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonService $personService)
    {
        //
    }
}
