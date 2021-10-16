<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'daily_budget' => $this->daily_budget,
            'total_budget' => $this->total_budget,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'images' => CampaignImageResource::collection($this->images),
            'created_at' => $this->created_at
        ];
    }
}
