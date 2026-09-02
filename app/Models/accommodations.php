<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodation_categories;
use App\Models\AccommodationImage;
use App\Models\facilities;
use App\Models\rules;
class accommodations extends Model
{
    use HasFactory;

    protected $table = 'accommodations';

    protected $fillable = [

        //relasi
        'category_id',

        //informasi penginapan
        'title',
        'slug',
        'thumbnail',

        //harga
        'price',

        //detail penginapan
        'link_gmaps',
        'address',
        'capacity',
        'bedroom',
        'bathroom',
        'size',

        //status
        'status',

        //deskripsi
        'description',

        //SEO
        'meta_title',
        'meta_description',


    ];

    public function category()
    {
        return $this->belongsTo(
            accommodation_categories::class,
            'category_id'
        );
    }

public function images()
{
    return $this->hasMany(
        AccommodationImage::class,
        'accommodation_id'
    );
}

public function facilities()
{
    return $this->belongsToMany(
        facilities::class,
        'accommodation_facilities',
        'accommodation_id',
        'facility_id'
    );
}

public function rules()
{
    return $this->belongsToMany(
        rules::class,
        'accommodation_rules',
        'accommodation_id',
        'rule_id'
    );
}

}
