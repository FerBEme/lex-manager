<?php
namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;
class FilterScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        /** @var Model $model */
        if(empty(request('filters'))) return;
        $table = $model->getTable();
        if($model instanceof User) return;
        if($builder->getQuery()->from !== $table) return;
        $columns = Schema::getColumnListing($table);
        $filters = request('filters');
        foreach ($filters as $column => $conditions) {
            if(!in_array($column,$columns)) continue;
            foreach ($conditions as $operator => $value) {
                if(in_array($operator,['!=','=','<=','<','>=','>'])) $builder->where("$table.$column",$operator,$value);
                if($operator === 'like') $builder->where("$table.$column",'like',"%$value%");
            }
        }
    }
}