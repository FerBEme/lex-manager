<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;
class SelectScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        /** @var Model $model */
        if(empty(request('select'))) return;
        $table = $model->getTable();
        $primaryKey = $model->getKeyName();
        $columns = Schema::getColumnListing($table);
        $selects = collect(explode(',',request('select')))
            ->map(fn($col) => trim($col))
            ->filter();
        $valid = $selects->filter(fn($col) => in_array($col,$columns));
        if(!$valid->contains($primaryKey)) $valid->push($primaryKey);
        if($table === 'users') {
            foreach (['role_id','lawyer_id'] as $col) {
                if(!$valid->contains($col)) $valid->push($col);
            }
        }
        $selectFinal = $valid
            ->unique()
            ->map(fn($col) => "$table.$col")
            ->toArray();
        if(!empty($selectFinal)) $builder->select($selectFinal);
    }
}