<?php

namespace App\Models;

use App\Models\User;
// use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $with = ['user', 'comments'];

    public function scopeSearch($query)
    {
        if (request('search')) {
            return $query->where('body', 'like', '%' . request('search') . '%');
        }
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
