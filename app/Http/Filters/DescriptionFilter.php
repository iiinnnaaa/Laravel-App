<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class DescriptionFilter {
    public function filter(Builder $builder, $value){
        return $builder->whereFullText(['name', 'description'], $value);
    }
}
