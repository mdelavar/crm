<?php

namespace App\Http\Controllers;

use App\Contracts\BoxRepository;
use App\Contracts\ProductRepository;
use App\Contracts\ProductSerialNumberRepository;
use App\Http\Requests\StoreProductSerialNumberBetweenRequest;
use App\Http\Requests\StoreProductSerialNumberRequest;
use App\Http\Resources\ProductSerialNumberCollection;
use App\Http\Resources\ProductSerialNumberResource;
use App\Models\ProductSerialNumber;
use App\Traits\SerialHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductSerialNumberController extends Controller
{

    use SerialHandler;
    public function __construct(private ProductSerialNumberRepository $productSerialNumberRepository, private ProductRepository $productRepository , private BoxRepository $boxRepository)
    {
        $this->resourceItem = ProductSerialNumberResource::class;
        $this->resourceCollection = ProductSerialNumberCollection::class;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cacheTag = 'product_serial';
        $cacheKey = 'product_serial:' . auth()->id() . json_encode(request()->all());

        return Cache::tags($cacheTag)->remember($cacheKey, now()->addHour(), function () {
            $collection = $this->productSerialNumberRepository->findByFilters();
            $products = $this->productRepository->all();
            $boxes = $this->boxRepository->all();
            return $this->respondWithCollection($collection)->additional(compact('products' , 'boxes'));
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
    public function store(StoreProductSerialNumberRequest $request)
    {
        $data = $request->validated();
        $response = $this->productSerialNumberRepository->store($data);
        return $this->respondWithItem($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductSerialNumber $productSerialNumber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductSerialNumber $productSerialNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductSerialNumberRequest $request, ProductSerialNumber $productSerialNumber)
    {
        $data = $request->validated();
        $response = $this->productSerialNumberRepository->update($productSerialNumber, $data);
        return $this->respondWithItem($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductSerialNumber $productSerialNumber)
    {
        //
    }

    public function autoBarcode(StoreProductSerialNumberBetweenRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $count = $data['count'];
            for ($i = 0; $i < $count; $i++) {
                $data['customer_serial'] = $this->getCustomerSerial(verta($data['ma_date'])->format('Ymd') , $data['product_id']);
                $data['representation_serial'] = $this->getRepresentationSerial(verta($data['ma_date'])->format('Ymd') , $data['product_id']);
                $response = $this->productSerialNumberRepository->store($data);
            }
            DB::commit();
            return $this->respondWithItem($response);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


}
