<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoryOrderStoreRequest;
use App\Http\Requests\HistoryOrderUpdateRequest;
use App\Models\HistoryOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryOrderController extends Controller
{
    public function index(Request $request): Response
    {
        $historyOrders = HistoryOrder::all();

        return view('historyOrder.index', compact('historyOrders'));
    }

    public function create(Request $request): Response
    {
        return view('historyOrder.create');
    }

    public function store(HistoryOrderStoreRequest $request): Response
    {
        $historyOrder = HistoryOrder::create($request->validated());

        $request->session()->flash('historyOrder.id', $historyOrder->id);

        return redirect()->route('historyOrder.index');
    }

    public function show(Request $request, HistoryOrder $historyOrder): Response
    {
        return view('historyOrder.show', compact('historyOrder'));
    }

    public function edit(Request $request, HistoryOrder $historyOrder): Response
    {
        return view('historyOrder.edit', compact('historyOrder'));
    }

    public function update(HistoryOrderUpdateRequest $request, HistoryOrder $historyOrder): Response
    {
        $historyOrder->update($request->validated());

        $request->session()->flash('historyOrder.id', $historyOrder->id);

        return redirect()->route('historyOrder.index');
    }

    public function destroy(Request $request, HistoryOrder $historyOrder): Response
    {
        $historyOrder->delete();

        return redirect()->route('historyOrder.index');
    }
}
