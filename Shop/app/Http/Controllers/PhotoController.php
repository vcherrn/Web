<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotoStoreRequest;
use App\Http\Requests\PhotoUpdateRequest;
use App\Models\Photo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PhotoController extends Controller
{
    public function index(Request $request): Response
    {
        $photos = Photo::all();

        return view('photo.index', compact('photos'));
    }

    public function create(Request $request): Response
    {
        return view('photo.create');
    }

    public function store(PhotoStoreRequest $request): Response
    {
        $photo = Photo::create($request->validated());

        $request->session()->flash('photo.id', $photo->id);

        return redirect()->route('photo.index');
    }

    public function show(Request $request, Photo $photo): Response
    {
        return view('photo.show', compact('photo'));
    }

    public function edit(Request $request, Photo $photo): Response
    {
        return view('photo.edit', compact('photo'));
    }

    public function update(PhotoUpdateRequest $request, Photo $photo): Response
    {
        $photo->update($request->validated());

        $request->session()->flash('photo.id', $photo->id);

        return redirect()->route('photo.index');
    }

    public function destroy(Request $request, Photo $photo): Response
    {
        $photo->delete();

        return redirect()->route('photo.index');
    }
}
