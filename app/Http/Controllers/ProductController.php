<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $service)
    {
    }

    public function index(Request $request)
    {
        return success($this->service->list($request->input()));
    }

    /**
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function save(Request $request)
    {
        $this->validate($request, []);
        return success($this->service->save($request->post()));
    }

    public function show(int $id)
    {

    }

    public function delete(int $id)
    {

    }
}
