<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnterpriseRequest;
use App\Http\Resources\EnterpriseCollection;
use App\Http\Resources\EnterpriseResource;
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
    }

    /**
     * @param StoreEnterpriseRequest $request
     * @return Response
     */
    public function save(StoreEnterpriseRequest $request)
    {
        $data = $request->post();
        $user = $request->user();
        if ($user->enterprise_id > 0) {
            $data['enterprise_id'] = $user->enterprise_id;
        }
        return success($this->service->save($data));
    }

    public function show($id, Request $request)
    {
        $user = $request->user();
        if ($user->enterprise_id > 0) {
            $id = $user->enterprise_id;
        }
        return success(new EnterpriseResource($this->service->getEnterpriseInfo($id)));
    }

    public function delete(int $id)
    {
        $this->service->delete($id);
        return success();
    }
}
