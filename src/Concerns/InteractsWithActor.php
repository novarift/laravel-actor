<?php

declare(strict_types=1);

namespace Novarift\Actor\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Novarift\Actor\Facades;
use Novarift\Actor\Models\Actor;

trait InteractsWithActor
{
    public function act(string $action, ?Model $actor = null, ?Carbon $at = null): Actor
    {
        /** @var Model $this */
        return Facades\Actor::act($this, $action, $actor, $at);
    }

    public function actors(): MorphMany
    {
        /** @var Model $this */
        return $this->MorphMany(Actor::class, 'resource');
    }

    public function actor(string $action): ?Actor
    {
        /** @var Model $this */
        return Facades\Actor::get($this, $action);
    }
}
