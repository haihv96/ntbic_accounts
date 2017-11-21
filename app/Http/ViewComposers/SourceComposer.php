<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class SourceComposer
{
    protected $source;

    public function __construct(Request $request)
    {
        $this->source = $request->source;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('source', $this->source);
    }
}