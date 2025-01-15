<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'value',
        'issuedAt',
        'user',
        'category'
    ];

    //belong
    public function user() {
        return $this->belongsTo(User::class, 'user');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category');
    }
}