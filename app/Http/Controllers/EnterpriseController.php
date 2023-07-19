<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnterpriseRequest;
use App\Http\Resources\EnterpriseCollection;
use App\Services\EnterpriseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnterpriseController extends Controller
{
    public function __construct(private readonly EnterpriseService $service)
    {
    }

    public function index(Request $request)
    {
        return new EnterpriseCollection($this->service->list($request->input()));
        return success(new EnterpriseCollection($this->service->list($request->input())));
    }

    /**
     * @param StoreEnterpriseRequest $request
     * @return Response
     */
    public function save(StoreEnterpriseRequest $request)
    {
        return success($this->service->save($request->post()));
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
