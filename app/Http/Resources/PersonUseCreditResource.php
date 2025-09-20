<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PersonUseCreditResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'organization_people_id' => $this->organization_people_id,
            'organization_people' => $this->organization_people->name,
            'organization' => $this->organization_people->organization->name,
            'car_service_id' => $this->car_service_id,
            'car_service' => $this->car_service->name,
            'service_id' => $this->service_id,
            'service' => $this->service->name,
            'amount' => $this->amount,
            'create_date_label' => verta($this->create_date)->format('d F Y - H:i'),
        ];
    }
}
