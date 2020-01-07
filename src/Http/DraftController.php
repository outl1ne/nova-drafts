<?php

namespace OptimistDigital\NovaDrafts\Http;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DraftController extends Controller
{
    public function publishDraft($draftId, Request $request) {
        return true;
    }
}
