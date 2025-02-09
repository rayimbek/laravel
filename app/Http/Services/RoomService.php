<?php


namespace App\Http\Services;


use App\Models\Room;
use App\Http\Resources\RoomResource;
use Illuminate\Http\Request;

class RoomService
{
    public function createRoom($data)
    {
        $room = Room::create($data);
        return new RoomResource($room);
    }

    public function getRoom($id)
    {
        $room = Room::findOrFail($id);
        return new RoomResource($room);
    }

}
