<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    public function __construct(private readonly CompanyService $service)
    {
    }

    public function index(Request $request)
    {
        return response()->success($this->service->list($request->input()));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function save(Request $request)
    {
        $this->validate($request, []);
        return $this->serivce->save($request->post());
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
