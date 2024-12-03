<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    protected $table = 'article_user_carts';

    protected $fillable = [
        'article_id',
        'user_id',
        'session_id'
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    public function scopeByUserId(Builder $query, string $userId): void
    {
        $query->where('user_id', $userId);
    }

    public function scopeBySessionId(Builder $query, string $sessionId): void
    {
        $query->where('session_id', $sessionId);
    }
}
