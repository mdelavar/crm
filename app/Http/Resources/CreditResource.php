<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $array = parent::toArray($request);
        $array['start_date_label'] = verta($this->start_date)->format('d F Y');
        $array['end_date_label'] = verta($this->end_date)->format('d F Y');

        return $array;
    }

}
