<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user',
    ];

    //belong
    public function user() {
        return $this->belongsTo(User::class, 'user');
    }

    //has
    public function expenses(){
        return $this->hasMany(Expense::class, 'category');
    }
}