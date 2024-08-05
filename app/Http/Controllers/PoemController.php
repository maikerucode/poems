<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PoemController extends Controller
{

    public function home(): View
{
    // Fetch the poem with the oldest last_accessed_at value
    $oldestAccessedPoem = Poem::orderBy('last_accessed_at', 'asc')->first();

    if ($oldestAccessedPoem) {
        // Update the last_accessed_at timestamp to now
        $oldestAccessedPoem->last_accessed_at = now();
        $oldestAccessedPoem->save();
    }

    return view('poems.client', [
        'poem' => $oldestAccessedPoem, // Pass the poem to the view
    ]);
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        
        return view('poems.index', [
            'poems' => Poem::latest()->paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'poem_proper' => 'nullable',
        ]);

        $poem_proper = $validatedData['poem_proper'] ?? '';
        $length = str_word_count($poem_proper);

        $poem = Poem::create([
            'title' => $validatedData['title'],
            'poem_proper' => $poem_proper,
            'length' => $length,
            'last_accessed_at' => now(),
        ]);

        return redirect()->route('poems.index', $poem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function show(Poem $poem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function edit(Poem $poem): View
    {
        dd(auth()->user()->is_user);
        Gate::authorize('update', $poem);

        $allTags = Tag::all();

        return view('poems.edit', [
            'poem' => $poem,
            'allTags' => $allTags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poem $poem): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'poem_proper' => 'nullable',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Calculate poem length
        $poem_proper = $validatedData['poem_proper'] ?? '';
        $length = str_word_count($poem_proper);

        // Update the poem
        $poem->update([
            'title' => $validatedData['title'],
            'poem_proper' => $poem_proper,
            'length' => $length,
            'last_accessed_at' => now(), // Update last accessed timestamp
        ]);

        $poem->tags()->sync($request->input('tags', []));

        return redirect()->route('poems.index', $poem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poem $poem): RedirectResponse
    {
        Gate::authorize('delete', $poem);

        $poem->delete();

        return redirect(route('poems.index'));
    }
}
