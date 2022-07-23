<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'img',
        'status',
        'category_id',
        
    ];
   

    protected $with = ['category'];
   
    public function category():HasOne
    {
        return $this->hasOne(Category::class,'id','category_id');
    }


}
