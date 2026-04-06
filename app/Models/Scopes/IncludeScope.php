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
        $relations = explode(',',request('include'));
        $builder->with($relations);
    }
}
