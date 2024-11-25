<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestTypeStoreRequest;
use App\Http\Requests\RequestTypeUpdateRequest;
use App\Models\RequestType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestTypeController extends Controller
{
    public function index(Request $request)
    {
        $requestTypes = RequestType::all();

        return $requestTypes;
    }

   
}
