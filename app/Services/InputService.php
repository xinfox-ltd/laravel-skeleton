<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Input;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InputService
{
    public function list(User $user, array $params): LengthAwarePaginator|array|\Illuminate\Database\Eloquent\Collection
    {
        return Input::where('inputs.enterprise_id', $user->enterprise_id)
            ->leftJoin('suppliers', 'suppliers.id', '=', 'inputs.supplier_id')
            ->join('input_categories', 'input_categories.id', '=', 'inputs.input_category_id')
            ->join('dosage_forms', 'dosage_forms.id', '=', 'inputs.dosage_form_id')
            ->select(
                [
                    'inputs.*',
                    'suppliers.name as supplier_name',
                    'input_categories.name as category_name',
                    'dosage_forms.name as dosage_form_name'
                ]
            )
            ->orderBy('inputs.id', 'DESC')
            ->paginate($params['page_size'] ?? 20);
    }

    public function save(array $data)
    {
        $data['supplier_id'] ??= 0;
        $data['enterprise'] ??= '';
        $data['registration_no'] ??= '';
        $data['component'] ??= '';
        $data['executive_standard'] ??= '';

        if (!empty($data['annex']) && is_string($data['annex'])) {
            $data['annex'] = explode(',', $data['annex']);
        }

        if (empty($data['id'])) {
            return Input::create($data);
        } else {
            $user = Input::findOrFail($data['id']);
            $user->update($data);
            return $user;
        }
    }

    public function get(int $id): Input
    {
        return Input::with('supplier')->findOrFail($id);
    }
}
