<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

class RelationResource extends JsonResource
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
            'title' => $this->title,
            'contact_id' => $this->contact_id,
            'relation_category_id' => $this->relation_category_id,
            'category' => $this->category,
            'contact' => $this->contact,
            'call_result' => $this->call_result,
            'call_time_label' => verta($this->call_time_label)->format('Y/m/d'),
            'call_time' => $this->call_time,
            'next_call_time' => $this->next_call_time,
            'next_call_time_label' => verta($this->next_call_time)->format('Y/m/d')
        ];
    }

}
