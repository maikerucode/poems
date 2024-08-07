<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $userId = Auth::id();
        if (auth()->user()->role === 'admin') {
            $letters = Letter::all();
        } else {
            $letters = Letter::where("author_id", $userId)->get();
        }

        return view("letters.index", ['letters' => $letters]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = $request->user()->id;

        $letter = new Letter();
        $letter->author_id = $user_id;
        $letter->title = $request->title;
        $letter->letter_body = $request->letter_body;
        $letter->save();

        return redirect()->route("letters.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $letter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter): RedirectResponse
    {
        Gate::authorize('delete', $letter);

        $letter->delete();
        return redirect(route('letters.index'));
    }
}
