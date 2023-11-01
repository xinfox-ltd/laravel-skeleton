<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Services;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class ChannelService
{
    public function list(array $params): array|LengthAwarePaginator
    {
        $type = $params['type'] ?? 1;
        return Channel::where('type', $type)
            ->when($params['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->orderBy('id', 'DESC')
            ->paginate($params['page_size'] ?? 10);
    }

    public function save(array $data)
    {
        if (empty($data['id'])) {
            return Channel::create($data);
        }

        $channel = Channel::findOrFail($data['id']);
        $channel->update($data);
        return $channel;
    }

    public function destroy(User $user, int $id): void
    {
        Channel::where('enterprise_id', $user->enterprise_id)->findOrFail($id)->delete();
    }
}
