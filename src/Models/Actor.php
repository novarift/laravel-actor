<?php

declare(strict_types=1);

namespace Novarift\Actor\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'action',
        'resource_type',
        'resource_id',
        'actor_type',
        'actor_id',
        'acted_at',
    ];

    protected function casts(): array
    {
        return [
            'acted_at' => 'datetime',
        ];
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('actor.tables.actor', parent::getTable());
    }

    public function resource(): MorphTo
    {
        return $this->morphTo();
    }

    public function actor(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeForResource(Builder $query, Model $resource): Builder
    {
        return $query->where('resource_type', $resource->getMorphClass())
            ->where('resource_id', $resource->getForeignKey());
    }

    public function scopeOfActor(Builder $query, Model $actor): Builder
    {
        return $query->where('actor_type', $actor->getMorphClass())
            ->where('actor_id', $actor->getForeignKey());
    }

    public function scopeOfAction(Builder $query, string $action): Builder
    {
        return $query->where('action', $action);
    }
}
