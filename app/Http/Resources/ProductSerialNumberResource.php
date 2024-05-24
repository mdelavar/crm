<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class ProductSerialNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'serial' => $this->serial,
            'description' => $this->description,
            'product_id' => $this->product_id,
            'pr' => $this->product,
            'ma_date_label' => verta($this->ma_date)->format('Y/m/d'),
            'ma_date' => $this->ma_date,
            'ex_date' => $this->ex_date,
            'ex_date_label' => verta($this->ex_date)->format('Y/m/d')
        ];
    }

}
