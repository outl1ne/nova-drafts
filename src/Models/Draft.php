<?php

namespace OptimistDigital\NovaDrafts\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        //$this->setTable(config('nova-blog.blog_posts_table', 'nova_blog_posts'));
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if ($post->is_pinned) {
                Post::where('is_pinned', true)->each(function ($pinnedPost) {
                    $pinnedPost->is_pinned = false;
                    $pinnedPost->save();
                });
            }
            if (isset($post->draft) && NovaBlog::draftsEnabled()) {
                unset($post['draft']);
                return Draft::createDraft($post);
            }
            return true;
        });
    }

    private static function createDraft($data)
    {
        if (isset($data->id)) {
            $newResource = $data->replicate();
            $newResource->published = false;
            $newResource->draft_parent_id = $data->id;
            $newResource->preview_token = Str::random(20);
            $newResource->save();
            return false;
        }

        $data->published = false;
        $data->preview_token = Str::random(20);
        return true;
    }

    public function draftParent($modelClass)
    {
        return $this->belongsTo($modelClass);
    }

    public function childDraft($modelClass)
    {
        return $this->hasOne($modelClass, 'draft_parent_id', 'id');
    }

    public function isDraft()
    {
        return isset($this->preview_token) ? true : false;
    }
}
