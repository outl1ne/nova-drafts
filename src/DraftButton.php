<?php

namespace OptimistDigital\NovaDrafts;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceDetailRequest;
use OptimistDigital\NovaDrafts\Models\Draft;

class DraftButton extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-draft-button';

    protected $enabled = true;

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string|null $attribute
     * @param mixed|null $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->withMeta([
            'asHtml' => true,
        ]);

        if (!$this->enabled) {
            $this->hideWhenUpdating();
            $this->hideFromDetail();
            $this->hideWhenCreating();
        }
        $this->hideFromIndex();
    }

    public function resolve($resource, $attribute = null)
    {
        if ($this->showDraftButton($resource)) {
            parent::resolve($resource, $attribute);

            $this->withMeta([
                'childDraft' => Draft::childDraft(get_class($resource), $resource->id),
                'isDraft' => (isset($resource->draft_parent_id) || (!isset($resource->draft_parent_id) && !$resource->published && isset($resource->id))),
            ]);
        }
    }

    protected function showDraftButton($resource)
    {
        return !(!$this->isDraft($resource) && (request() instanceof ResourceDetailRequest)) || isset($this->childDraft);
    }

    protected function isDraft($resource)
    {
        return (isset($resource->draft_parent_id) || (!isset($resource->draft_parent_id) && !$resource->published && isset($resource->id)));
    }

    public function draftsEnabled($enabled)
    {
        $this->enabled = is_bool($enabled) ? $enabled : false;
        return $this;
    }

    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        $draft_model = new Draft();
        if (isset($request->draft) && $draft_model->draftsEnabled()) {
            Draft::createDraft($model);
            $model->refresh();
            $model->save();
            return true;
        }
        return true;
    }
}
