<?php

namespace App\Http\Filters;

class NameFilter {
    public function filter($builder, $value){
     return $builder->where('name', $value);
    }
}
