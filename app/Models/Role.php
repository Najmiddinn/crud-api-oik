<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    public $timestamps = false;

    protected $fillable = ['role'];

    public static function rules()
    {
        return [
            'role' => 'string|required',
        ];
    }

    public function user():HasMany
    {
        return $this->hasMany(User::class);
    }

}
