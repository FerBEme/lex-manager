<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
class IncludeScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        if (empty(request('include'))) {
            return ;
        }
        $includes = explode(',',request('include'));
        $relations = collect($includes)->filter(function ($relation) use ($model) {
            return method_exists($model,$relation);
        })->values()->all();
        if (!empty($relations)) {
            $builder->with($relations);
        }
    }
}
