<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'message' => $this->message,
            'status' => $this->status,
            'priority' => $this->priority,
            'type' => $this->type,
            'startDate' => Carbon::make($this->start_date)->format('Y-m-d'),
            'endDate' => Carbon::make($this->end_date)->format('Y-m-d'),
        ];
    }
}
