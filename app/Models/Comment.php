<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'body',
        'visible'
    ];
    protected $casts = [
        'visible' => 'boolean'
    ];

    public function article()
    {
        return $this->hasMany(User::class);
    }
}
