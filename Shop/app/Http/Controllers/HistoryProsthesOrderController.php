<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryProsthesOrderStoreRequest;
use App\Http\Requests\HistoryProsthesOrderUpdateRequest;
use App\Models\HistoryProsthesOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryProsthesOrderController extends Controller
{
    public function index(Request $request): Response
    {
        $historyProsthesOrders = HistoryProsthesOrder::all();

        return view('historyProsthesOrder.index', compact('historyProsthesOrders'));
    }

    public function create(Request $request): Response
    {
        return view('historyProsthesOrder.create');
    }

    public function store(HistoryProsthesOrderStoreRequest $request): Response
    {
        $historyProsthesOrder = HistoryProsthesOrder::create($request->validated());

        $request->session()->flash('historyProsthesOrder.id', $historyProsthesOrder->id);

        return redirect()->route('historyProsthesOrder.index');
    }

    public function show(Request $request, HistoryProsthesOrder $historyProsthesOrder): Response
    {
        return view('historyProsthesOrder.show', compact('historyProsthesOrder'));
    }

    public function edit(Request $request, HistoryProsthesOrder $historyProsthesOrder): Response
    {
        return view('historyProsthesOrder.edit', compact('historyProsthesOrder'));
    }

    public function update(HistoryProsthesOrderUpdateRequest $request, HistoryProsthesOrder $historyProsthesOrder): Response
    {
        $historyProsthesOrder->update($request->validated());

        $request->session()->flash('historyProsthesOrder.id', $historyProsthesOrder->id);

        return redirect()->route('historyProsthesOrder.index');
    }

    public function destroy(Request $request, HistoryProsthesOrder $historyProsthesOrder): Response
    {
        $historyProsthesOrder->delete();

        return redirect()->route('historyProsthesOrder.index');
    }
}
