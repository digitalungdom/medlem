<?php

namespace App\Http\Controllers;

use App\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('events', Events::class);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->authorize('events', Events::class);
        $post = $request->validate([
            'name' => 'required|unique:events|max:190',
            'slug' => 'required|unique:events|max:24',
            'startTime' => 'required|date|after:today',
            'stopTime' => 'required|date|after:today'
        ]);
        Events::create([
            'name' => $post['name'],
            'slug' => $post['slug'],
            'startTime' => $post['startTime'],
            'stopTime' => $post['stopTime']
            ]);

        return redirect(route('events.admin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit($events)
    {
        //
        $this->authorize('events', Events::class);
        $event = Events::where('slug',$events)->firstOrFail();
        return view('events.edit')->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Events $event)
    {
        //
        $this->authorize('events', Events::class);

        $post = $request->validate([
            'name' => 'required|unique:events,name,'.$event->id.'|max:190',
            'slug' => 'required|unique:events,slug,'.$event->id.'|max:24',
            'startTime' => 'required|date|after:today',
            'stopTime' => 'required|date|after:today',
            'maxUsers' => 'required|numeric|min:-1',
            'mustBeMember' => 'nullable|boolean',
            'ticketPrice' => 'required|numeric|min:0'
        ]);
        $event->update($post);
        return redirect(route('events.admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $events)
    {
        //
        $this->authorize('events', Events::class);
    }

    public function adminindex() {
        $this->authorize('events', Events::class);
        $events = Events::latest()->get();
        #ddd($events);
        return view("events.admin", [
            'events' => $events
            ]);

    }
}
