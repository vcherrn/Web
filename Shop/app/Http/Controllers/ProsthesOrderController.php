<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProsthesOrderStoreRequest;
use App\Http\Requests\ProsthesOrderUpdateRequest;
use App\Models\ProsthesOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProsthesOrderController extends Controller
{
    public function index(Request $request): Response
    {
        $prosthesOrders = ProsthesOrder::all();

        return view('prosthesOrder.index', compact('prosthesOrders'));
    }

    public function create(Request $request): Response
    {
        return view('prosthesOrder.create');
    }

    public function store(ProsthesOrderStoreRequest $request): Response
    {
        $prosthesOrder = ProsthesOrder::create($request->validated());

        $request->session()->flash('prosthesOrder.id', $prosthesOrder->id);

        return redirect()->route('prosthesOrder.index');
    }

    public function show(Request $request, ProsthesOrder $prosthesOrder): Response
    {
        return view('prosthesOrder.show', compact('prosthesOrder'));
    }

    public function edit(Request $request, ProsthesOrder $prosthesOrder): Response
    {
        return view('prosthesOrder.edit', compact('prosthesOrder'));
    }

    public function update(ProsthesOrderUpdateRequest $request, ProsthesOrder $prosthesOrder): Response
    {
        $prosthesOrder->update($request->validated());

        $request->session()->flash('prosthesOrder.id', $prosthesOrder->id);

        return redirect()->route('prosthesOrder.index');
    }

    public function destroy(Request $request, ProsthesOrder $prosthesOrder): Response
    {
        $prosthesOrder->delete();

        return redirect()->route('prosthesOrder.index');
    }
}
