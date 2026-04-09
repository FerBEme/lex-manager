<?php
namespace App\Traits;
use App\Models\Scopes\FilterScope;
use App\Models\Scopes\IncludeScope;
use App\Models\Scopes\SelectScope;
use App\Models\Scopes\SortScope;
trait ApiTrait {
    protected static function booted(): void {
        static::addGlobalScopes([
            FilterScope::class,
            SelectScope::class,
            SortScope::class,
            IncludeScope::class,
        ]);
    }
    public function scopeGetOrPaginate($query){
        if (request('perPage')) {
            return $query->paginate(request('perPage'));
        }
        return $query->get();
    }
}