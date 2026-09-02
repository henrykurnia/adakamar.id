<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accommodation extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Nama tabel.
     */
    protected $table = 'accommodations';

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'thumbnail',
        'price',
        'address',
        'capacity',
        'bedroom',
        'bathroom',
        'size',
        'status',
        'description',
        'meta_title',
        'meta_description',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'bedroom' => 'integer',
        'bathroom' => 'integer',
    ];

    /**
     * Relasi ke kategori akomodasi.
     *
     * Satu accommodation memiliki satu category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            AccommodationCategory::class,
            'category_id'
        );
    }

    /**
     * Relasi ke gambar accommodation.
     *
     * Satu accommodation dapat memiliki banyak gambar.
     */
    public function images(): HasMany
    {
        return $this->hasMany(
            AccommodationImage::class,
            'accommodation_id'
        )->orderBy('sort_order');
    }

    /**
     * Relasi ke fasilitas.
     *
     * Satu accommodation dapat memiliki banyak facility.
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(
            Facility::class,
            'accommodation_facilities',
            'accommodation_id',
            'facility_id'
        )->withTimestamps();
    }

    /**
     * Relasi ke aturan.
     *
     * Satu accommodation dapat memiliki banyak rule.
     */
    public function rules(): BelongsToMany
    {
        return $this->belongsToMany(
            Rule::class,
            'accommodation_rules',
            'accommodation_id',
            'rule_id'
        )->withTimestamps();
    }
}
