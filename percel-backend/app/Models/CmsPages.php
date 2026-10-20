<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CmsPages extends Model
{
    use Sluggable;

    // Table name (if different from default 'cms_pages')
    protected $table = 'cms_pages';

    // Fillable fields
    protected $fillable = [
        'page_title',
        'page_slug',
        'page_content',
        'featured_image',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'status',
        'created_by',
        'user_ip',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Sluggable package.
     */
    public function sluggable(): array
    {
        return [
            'page_slug' => [
                'source' => 'meta_title', // slug will be generated from meta_title
            ]
        ];
    }
}