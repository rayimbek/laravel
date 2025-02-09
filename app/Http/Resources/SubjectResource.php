<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'name' => $this->first_name,
            'teacher_id' => $this->teacher_id,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'surname' => $this->user->surname,
                'date_of_birth' => $this->user->date_of_birth,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
            ],
        ];
    }
}
