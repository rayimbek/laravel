<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
abstract class BaseController extends Controller
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function store(FormRequest $request)
    {
        $data = $request->validated();
        return response()->json($this->service->create($data), 201);
    }

    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }
}
