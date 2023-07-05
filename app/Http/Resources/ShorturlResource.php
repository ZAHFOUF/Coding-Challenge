<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShorturlResource extends JsonResource
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
            'id' => $this->id ,
            'origin_url' => $this->origin_url ,
            'short_url' => env('APP_URL') . $this->short_url ,
            'clicks' => $this->clicks ,
            'lastclick' => $this->lastclick
        ];
    }
}
