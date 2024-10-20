<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     * Add a where clause with LIKE for multiple columns.
     *
     * @param Builder $query
     * @param string $search
     * @param array $columns
     * @return Builder
     */
    public function scopeWhereLike(Builder $query, string $search, array $columns): Builder
    {
        return $query->where(function ($query) use ($search, $columns) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%{$search}%");
            }
        });
    }
}
