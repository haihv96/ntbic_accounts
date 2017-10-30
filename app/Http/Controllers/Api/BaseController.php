<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    protected $currentUser;

    public function __construct(Request $request)
    {
        $this->currentUser = $request->user();
    }
}
