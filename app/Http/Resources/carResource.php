<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class carResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "car_number" => $this->car_number,
            "car_code" => $this->car_code
        ];
    }
}
