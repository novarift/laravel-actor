<?php

namespace Novarift\Actor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Actor {
    public function act(Model $resource, string $action, ?Model $actor = null, ?Carbon $at = null): Models\Actor
    {
        $actor ??= auth()->user();

        if (empty($actor)) {
            throw new \InvalidArgumentException('No authenticated user to set as actor.');
        }

        /** @var Model $actor */

        $at ??= now();

        return Models\Actor::query()
            ->updateOrCreate([
                'action' => $action,
                'resource_type' => $resource->getMorphClass(),
                'resource_id' => $resource->getForeignKey(),
            ], [
                'actor_type' => $actor->getMorphClass(),
                'actor_id' => $actor->getForeignKey(),
                'acted_at' => $at,
            ]);
    }

    public function get(Model $resource, string $action): ?Models\Actor
    {
        return Models\Actor::query()
            ->forResource($resource)
            ->ofAction($action)
            ->latest('acted_at')
            ->first();
    }
}
