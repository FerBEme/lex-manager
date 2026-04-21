<?php
namespace App\Traits;
use App\Models\Scopes\FilterScope;
use App\Models\Scopes\IncludeScope;
use App\Models\Scopes\SelectScope;
use App\Models\Scopes\SortScope;
use Illuminate\Database\Eloquent\Builder;
trait ApiTrait {
    public static function bootApiTrait(): void{
        static::addGlobalScope(new FilterScope);
        static::addGlobalScope(new SelectScope);
        static::addGlobalScope(new SortScope);
        static::addGlobalScope(new IncludeScope);
    }
    public function scopeGetOrPaginate(Builder $query){
        if(request('perPage')) return $query->paginate(request('perPage'));
        return $query->get();
    }
}