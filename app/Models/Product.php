<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Filters\ProductFilter;
use Illuminate\Database\Eloquent\Builder;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'count',
        'category_id', //TODO categories table
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Cart - uid, product_id
    // OrderProduct (many to many) order_id product_id
    // Order user id, total

    public function scopeFilter(Builder $builder, $request){
        return (new ProductFilter($request))->filter($builder);
    }
}
