<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'parent_category_id'
    ];

    

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }


    public function parent():HasOne
    {
        return $this->hasOne(self::class, 'id','parent_category_id');
    }

}
