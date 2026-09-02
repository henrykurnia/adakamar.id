<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodation_categories;
use App\Models\User;

class articles extends Model
{
    use HasFactory;

    protected $table = 'articles';

    public $timestamps = true;
    protected $fillable = [

        'category_id',
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'published_at',
        
    ];

   

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(
            article_categories::class,
            'category_id',
            'id'
        );
    }

}
