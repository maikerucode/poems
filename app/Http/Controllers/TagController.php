<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        return view('poems.tags', [
            'tags' => Tag::latest()->paginate(2),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = Tag::create([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('tags.index', $tag);
    }

    public function edit(Tag $tag): View
    {
        Gate::authorize('update', $tag);

        return view('poems.rename', [
            'tag' => $tag,
        ]);
    }

    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('tags.index', $tag);
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        Gate::authorize('delete', $tag);

        $tag->delete();

        return redirect(route('tags.index'));
    }
}
