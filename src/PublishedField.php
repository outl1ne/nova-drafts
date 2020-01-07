<?php

namespace OptimistDigital\NovaDrafts;

use Laravel\Nova\Fields\Field;
use OptimistDigital\NovaDrafts\Models\Draft;

class PublishedField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-published-field';

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  mixed|null  $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, 'published', $resolveCallback);

        $this->withMeta([
            'asHtml' => true,
        ]);

        $this->exceptOnForms();
    }

    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);

        $this->withMeta([
            'childDraft' => Draft::childDraft(get_class($resource), $resource->id),
            'draftParent' => Draft::draftParent(get_class($resource), $resource->draft_parent_id)
        ]);
    }
}
