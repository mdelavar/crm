<?php

namespace App\Http\Controllers;

use App\Contracts\BoxRepository;
use App\Contracts\RepresentationRepository;
use App\Http\Requests\StoreBoxRequest;
use App\Http\Resources\BoxCollection;
use App\Http\Resources\BoxResource;
use App\Models\Box;
use App\Traits\SerialHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BoxController extends Controller
{
    use SerialHandler;

    public function __construct(private BoxRepository $boxRepository, private RepresentationRepository $representationRepository)
    {
        $this->resourceItem = BoxResource::class;
        $this->resourceCollection = BoxCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'boxes';
        $cacheKey = 'boxes:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->boxRepository->findByFilters();
            $representations = $this->representationRepository->all();
            return $this->respondWithCollection($collection)->additional(compact('representations'));
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
    public function store(StoreBoxRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $count = $data['count'];

            $response = null;
            for ($i = 0; $i < $count; $i++) {
                $data['barcode'] = $this->getBoxSerial($data['representation_id']);
                $response = $this->boxRepository->store($data);
            }
            DB::commit();
            return $this->respondWithItem($response);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Box $box)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Box $box)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBoxRequest $request, Box $box)
    {
        $data = $request->validated();
        $response = $this->boxRepository->update($box, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Box $representation)
    {
        //
    }
}
