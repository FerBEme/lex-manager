<?php
namespace App\Models\Scopes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;
class SelectScope implements Scope {
    public function apply(Builder $builder, Model $model): void {
        if (empty(request('select'))) {
            return;
        }

        /** @var Model $model */
        $table = $model->getTable();
        $keyName = $model->getkeyName();

        $select = request('select');
        $selectArray = explode(',', $select);

        $columns = collect($selectArray)
            ->map(fn ($column) => trim($column))
            ->filter(fn ($column) => Schema::hasColumn($table, $column))
            ->values()
            ->all();

        if (! in_array($keyName, $columns)) {
            $columns[] = $keyName;
        }

        if (! empty($columns)) {
            $builder->select($columns);
        }
    }
}