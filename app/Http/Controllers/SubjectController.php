<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Services\SubjectService;
use App\Http\Resources\SubjectResource;

class SubjectController extends BaseController
{

    public function __construct(SubjectService $subjectService)
    {
        parent::__construct($subjectService);
    }

    public function store(StoreSubjectRequest|\Illuminate\Foundation\Http\FormRequest $request)
    {
        return parent::store($request);
    }
}
