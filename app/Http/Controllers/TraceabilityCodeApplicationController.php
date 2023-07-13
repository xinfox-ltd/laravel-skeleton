<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TraceabilityCodeApplicationController extends Controller
{
    public function index()
    {

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
