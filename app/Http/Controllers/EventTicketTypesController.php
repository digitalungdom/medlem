<?php

namespace App\Http\Controllers;

use App\EventTicketTypes;
use Illuminate\Http\Request;
use App\Events;

class EventTicketTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event)
    {
        $this->authorize('events', Events::class);
        $event_info = Events::where('slug',$event)->firstOrFail();
        $tickettypes = EventTicketTypes::where('event_id', $event_info->id)->get();
        return view('events.tickettypes.index')->with('tickettypes', $tickettypes)->with('event', $event_info);
        //
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
    public function store(Request $request)
    {
        //
        $this->authorize('events', Events::class);
        $post = $request->validate([
            'name' => 'required|unique:events|max:190',
            'price' => 'numeric|min:0',
            'event_id' => 'required|exists:events,id'
        ]);
        EventTicketTypes::create([
            'name' => $post['name'],
            'event_id' => $post['event_id'],
            'price' => $post['price'],
            ]);
        $event = Events::findOrFail($post['event_id']);
        return redirect(route('tickettypes.index', ['event' => $event->slug]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventTicketTypes  $eventTicketTypes
     * @return \Illuminate\Http\Response
     */
    public function show(EventTicketTypes $eventTicketTypes)
    {
        //
        return "Her mangler noe";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventTicketTypes  $eventTicketTypes
     * @return \Illuminate\Http\Response
     */
    public function edit($event, $eventTicketTypes)
    {
        //
        $this->authorize('events', Events::class);
        $event = Events::where('slug', $event)->get();
        $tickettype = EventTicketTypes::findOrFail($eventTicketTypes);

        #dd($event, $tickettype);
        
        return view('events.tickettypes.edit')->with('tickettype', $tickettype)->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventTicketTypes  $eventTicketTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$event, $tickettype)
    {
        //

        $this->authorize('events', Events::class);
        
        $tickettype = EventTicketTypes::findOrFail($tickettype);
        $event = Events::firstOrFail('slug',$event);

        $post = $request->validate([
            'name' => 'required|unique:events|max:190',
            'price' => 'required|numeric|min:0',
            'maxPerUser' => 'required|numeric|min:1',
            'description' => 'nullable',
            
        ]);
        
        $post['enabled'] = $request->input('enabled') ? 1: 0;
        $tickettype->update($post);
        
        return redirect(route('tickettypes.index', ['event' => $event->slug]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventTicketTypes  $eventTicketTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $event, EventTicketTypes $tickettype)
    {
        //
        $this->authorize('events', Events::class);
        // FIXME: Should not be able to delete if someone has bought this tickettype
        
        $tickettype->delete();
        
        
        return redirect(route('tickettypes.index', ['event' => $event->slug]));
    }
}
