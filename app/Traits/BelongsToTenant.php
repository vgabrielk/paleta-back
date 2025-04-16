<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        if (auth()->check() && auth()->user()->tenant_id) {
            $builder->where('tenant_id', auth()->user()->tenant_id);
        }
    }
}

trait BelongsToTenant
{
    protected static function bootBelongsToTenant()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (auth()->check() && is_null($model->tenant_id)) {
                $model->tenant_id = auth()->user()->tenant_id;
            }
        });
    }

    public function scopeWithoutTenant($query)
    {
        return $query->withoutGlobalScope(TenantScope::class);
    }
}
