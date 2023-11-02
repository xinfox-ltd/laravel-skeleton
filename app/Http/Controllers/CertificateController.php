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
        return new CertificateCollection($this->service->list($request->user(), $request->input()));
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
                'subtype' => 'integer',
                'certificate_no' => 'required',
                'authority' => '',
                'valid_date' => 'array',
                'scan_file' => 'required'
            ]
        );

        $data['enterprise_id'] = $request->user()->enterprise_id;
        $data['authority'] ??= '';

        return $this->service->save($data);
    }

    public function show(int $id)
    {
    }

    public function delete(int $id, Request $request)
    {
        $this->service->delete($request->user(), $id);
        return success();
    }
}
