<?php

namespace App\Http\Filters;

class ProductFilter extends AbstractFilter{
    protected $filters = [
        'name'=>NameFilter::class,
        'min'=>MinPriceFilrer::class,
        'max'=>MaxPriceFilter::class,
        'description'=>DescriptionFilter::class,
        'category'=>CategoryFilter::class,
    ];
}
