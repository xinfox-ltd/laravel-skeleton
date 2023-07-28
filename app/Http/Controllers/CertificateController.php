<?php

namespace App\Http\Controllers;

use App\Http\Resources\CertificateCollection;
use App\Services\CertificateService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CertificateController extends Controller
{
    public function __construct(private readonly CertificateService $service)
    {
    }

    public function index(Request $request)
    {
        return new CertificateCollection($this->service->list($request->input()));
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function save(Request $request)
    {
        $data = $this->validate($request,
            [
                'id' => 'integer',
                'name' => 'required',
                'type' => 'required',
                'certificate_no' => 'required',
                'authority' => 'required',
                'scan_file' => 'required'
            ]
        );
        return $this->service->save($data);
    }

    public function show(int $id)
    {
    }

    public function delete(int $id)
    {
    }
}
