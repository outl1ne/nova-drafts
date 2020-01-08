<?php

namespace OptimistDigital\NovaDrafts\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use OptimistDigital\NovaDrafts\Models\Draft;

class DraftController extends Controller
{
    public function publishDraft($draftId, Request $request)
    {
        $resource_class = $request->input('class');
        $draft_to_publish = $resource_class::find($draftId);

        if (isset($draft_to_publish)) {
            $draft_parent = Draft::draftParent($resource_class, $draft_to_publish->draft_parent_id);

            if ($draft_parent !== null) {
                $published_draft = $draft_parent;
                foreach ($draft_to_publish->toArray() as $draft_column => $value) {
                    if (!in_array($draft_column, ['id', 'draft_parent_id', 'preview_token', 'created_at'])) {
                        $published_draft[$draft_column] = $draft_to_publish[$draft_column];
                    }
                }
                $published_draft->published = true;
                $published_draft->save();
                $draft_to_publish->delete();
                return $published_draft;
            } else {
                $draft_to_publish->published = true;
                $draft_to_publish->preview_token = null;
                $draft_to_publish->save();
                return $draft_to_publish;
            }
        }
        return $draft_to_publish;
    }
}
