<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'week_day', 'subject', 'start_time', 'end_time'];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }


}
