<?php

namespace App\Http\Controllers\Chirp;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Http\Requests\ChirpRequest;
use Illuminate\Support\Facades\Log;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('ChirpController@index');
        return Inertia::render('Chirps/Index', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
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
    public function store(ChirpRequest $request): RedirectResponse
    {
        $request->user()->chirps()->create($request->validated());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChirpRequest $request, Chirp $chirp): RedirectResponse
    {
        Gate::authorize('update', $chirp);
        $chirp->update($request->validated());
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse //ändra till redirect?
    {
        Gate::authorize('delete', $chirp);
        
        $chirp->delete();
        
        return redirect('/');
    }
}
