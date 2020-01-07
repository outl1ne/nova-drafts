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
        $this->setTable(config('nova-blog.blog_posts_table', 'nova_blog_posts'));
    }

    public static function createDraft($data)
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

    public function draftParent($class, $id)
    {
        $parent = $class::where('id', $id)->get()->first();
        if ($parent === null) return null;
        return $parent->toArray();
    }

    public static function childDraft($class, $id)
    {
        $child = $class::where('draft_parent_id', $id)->get()->first();
        if ($child === null) return null;
        return $child->toArray();
    }

    public function isDraft()
    {
        return isset($this->preview_token) ? true : false;
    }

    public function draftsEnabled()
    {
        return true;
    }
}
