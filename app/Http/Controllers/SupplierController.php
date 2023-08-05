<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Resources\SupplierCollection;
use App\Services\SupplierService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class SupplierController extends Controller
{
    public function __construct(private readonly SupplierService $service)
    {
    }

    public function index(Request $request)
    {
        return new SupplierCollection($this->service->list($request->user(), $request->input()));
    }

    /**
     * @param StoreSupplierRequest $request
     * @return Response
     */
    public function save(StoreSupplierRequest $request)
    {
        $data = $request->validated();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        $this->service->save($data);
        return success();
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
