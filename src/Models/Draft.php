<?php

namespace OptimistDigital\NovaDrafts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Draft extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
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

    public static function childDraft($class, $id)
    {
        $child = $class::where('draft_parent_id', $id)->get()->first();
        if ($child === null) return null;
        return $child->toArray();
    }

    public static function draftParent($class, $id)
    {
        $parent = $class::where('id', $id)->get()->first();
        if ($parent === null) return null;
        return $parent;
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
