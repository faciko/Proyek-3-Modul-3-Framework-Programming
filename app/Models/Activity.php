<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'code',
        'title',
        'description',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'status',
        'poster_path',
        'registered_count',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $query->when($filters['search'] ?? null, function (Builder $query, string $search): void {
            $search = trim($search);

            if ($search === '') {
                return;
            }

            $query->where(function (Builder $subQuery) use ($search): void {
                $subQuery->where('title', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        });

        $query->when($filters['category_id'] ?? null, function (Builder $query, int $categoryId): void {
            $query->where('category_id', $categoryId);
        });

        $query->when($filters['status'] ?? null, function (Builder $query, string $status): void {
            $query->where('status', $status);
        });

        $sort = $filters['sort'] ?? 'latest';
        if ($sort === 'oldest') {
            return $query->orderBy('start_at');
        } else {
            return $query->orderByDesc('start_at');
        }
    }
}
