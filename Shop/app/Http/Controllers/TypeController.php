<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeStoreRequest;
use App\Http\Requests\TypeUpdateRequest;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeController extends Controller
{
    public function index(Request $request)
    {
        $types = Type::all();

        return $types;
    }

    
}
