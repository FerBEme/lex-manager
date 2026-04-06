<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
class SortScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        if (empty(request('sort'))) {
            return;
        }
        $sorts = explode(',',request('sort'));
        foreach ($sorts as $sort) {
            $direccion = 'asc';
            if (substr($sort,0,1) === '-') {
                $direccion = 'desc';
                $sort = substr($sort,1);
            }
            $builder->orderBy($sort,$direccion);
        }
    }
}
