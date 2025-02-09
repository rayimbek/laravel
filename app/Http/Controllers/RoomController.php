<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Services\RoomService;
use App\Http\Resources\RoomResource;

class RoomController extends Controller
{
    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function store(StoreRoomRequest $request)
    {
        $room = $this->roomService->createRoom($request->validated());
        return $room;
    }

    public function show($id)
    {
        $room = $this->roomService->getRoom($id);
        return $room;
    }
}
