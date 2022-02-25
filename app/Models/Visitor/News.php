<?php

namespace App\Models\Visitor;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'visitor_news';

    protected $keyType = 'string';

    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'news_title',
        'news_slug',
        'news_content',
        'news_photo_path',
        'news_sticky_state',
        'news_publish_status',
        'news_publish_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
