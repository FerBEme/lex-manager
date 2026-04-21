<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
class SortScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        /** @var Model $model */
        $table = $model->getTable();
        if(empty(request('sort'))) return;
        $sorts = explode(',',request('sort'));
        foreach ($sorts as $sort) {
            $direction = 'asc';
            if(substr($sort,0,1) === '-') {
                $direction = 'desc';
                $sort = substr($sort,1);
            }
            $builder->orderBy("$table.$sort",$direction);
        }
    }
}