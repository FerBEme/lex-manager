<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class SortScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        /** @var Model $model */
        $table = $model->getTable();
        if (empty(request('sort'))) {
            return;
        }
        $sort = request('sort');
        $sortArray = explode(',',$sort);
        foreach ($sortArray as $sortField) {
            $direction = 'asc';
            if (substr($sortField,0,1) === '-') {
                $direction = 'desc';
                $sortField = substr($sortField,1);
            }
            if (!Schema::hasColumn($table,$sortField)) {
                continue;
            }
            $builder->orderBy($sortField,$direction);
        }
    }
}
