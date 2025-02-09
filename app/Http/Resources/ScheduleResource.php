<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'week_day' => $this->day,
            'subject' => $this->subject,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'room' => [
                'id' => $this->room->id,
                'name' => $this->room->name,
            ],
        ];
    }
}
