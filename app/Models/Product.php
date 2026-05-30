<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_active',
    ];

protected $casts = [
    'is_active' => 'boolean',
    'price' => 'integer',
];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
    public function getThumbnailUrlAttribute(): string
{
    $image = $this->images()->first();

    if (!$image) {
        // تصویر پیش‌فرض اگر محصول عکس نداشت
        return 'https://via.placeholder.com/600x400?text=No+Image';
    }

    return Storage::url($image->path);
}
}
