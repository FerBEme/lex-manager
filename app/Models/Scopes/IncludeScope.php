<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
class IncludeScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        /** @var Model $model */
        $table = $model->getTable();
        if(empty(request('include'))) return;
        if($builder->getQuery()->from !== $table) return;
        $includes = collect(explode(',',request('include')))
            ->map(fn($rel) => trim($rel))
            ->filter(fn($rel) => method_exists($model,$rel));
        if (!empty($includes)) {
            $builder->with($includes->mapWithKeys(fn($rel) => [
                $rel => fn($q) => $q->withoutGlobalScopes([
                    SelectScope::class,
                    SortScope::class,
                    FilterScope::class
                ])
            ])->toArray());
        }
    }
}