<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'count',
        'description',
        'category_id', //TODO categories table
        'price'
    ];

    public function categories(){
        return $this->hasMany(Category::class);
    }
}
