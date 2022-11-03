<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'store_id','name','description','price','amount'
    ];
    
    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
