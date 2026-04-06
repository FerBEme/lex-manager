<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
class FilterScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        if (empty(request('filters'))) {
            return ;
        }
        $filters = request('filters');
        foreach ($filters as $column => $condition) {
            foreach ($condition as $operator => $value) {
                if (in_array($operator,['!=','=','<','>','<=','>='])) {
                    $builder->where($column,$operator,$value);
                }
                if ($operator === 'like') {
                    $builder->where($column,'like',"%$value%");
                }
            }
        }
    }
}