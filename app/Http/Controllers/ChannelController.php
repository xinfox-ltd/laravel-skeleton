<?php

/*
 * Copyright (c) 2023. Moonstone. All rights reserved.
 */
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChannelRequest;
use App\Http\Resources\ChannelCollection;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use App\Services\ChannelService;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function __construct(protected ChannelService $service)
    {
    }

    public function index(Request $request)
    {
        return new ChannelCollection($this->service->list($request->input()));
    }

    public function store(ChannelRequest $request)
    {
        $data = $request->validated();
        $data['enterprise_id'] = $request->user()->enterprise_id;
        return success(new ChannelResource($this->service->save($request->validated())));
    }

    public function show(Channel $channel)
    {
        return $channel;
    }

    public function update(ChannelRequest $request, Channel $channel)
    {
        $channel->update($request->validated());

        return $channel;
    }

    public function destroy(int $id, Request $request)
    {
        $this->service->destroy($request->user(), $id);

        return success();
    }
}
