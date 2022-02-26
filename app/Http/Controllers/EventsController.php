<?php

namespace App\Http\Controllers;

use App\Events;
use App\EventType;
use App\EventTicketTypes;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $events = Events::where('stopTime', '>=', Carbon::now())->get();
        return view('events.index')->with('events', $events);
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
            'stopTime' => 'required|date|after:today',
            'event_types_id' => 'required'
        ]);
        Events::create([
            'name' => $post['name'],
            'slug' => $post['slug'],
            'startTime' => $post['startTime'],
            'stopTime' => $post['stopTime'],
            'event_types_id' => $post['event_types_id']
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
        #$events = Events::latest()->get();
        #ddd($events);
        return view("events.admin", [
            'events' => Events::latest()->get(),
            'event_types' => EventType::all()
            ]);

    }

    public function signup($eventslug) {
        $event = Events::where('slug', $eventslug)->with('ticketTypes')->with('tickets')->first();
        $user = Auth::user();
#        if($event->canSignup()) {
            return view('events.signup')->with('user', $user)->with('event', $event);
#        }
        
    }

    public function doSignup($eventslug, Request $request) {
        $event = Events::where('slug', $eventslug)->first();
        $validated = $request->validate([
            'ticketType' => 'required|exists:event_ticket_types,id',
            'numberOfTickets' => 'integer'

        ]);
        
        $tickettype = EventTicketTypes::find($validated['ticketType']);
        $previous_tickets = Ticket::where('owner', auth()->user()->id)
            ->where('ticketType', $validated['ticketType'])
            ->count();
        $numTickets = $validated['numberOfTickets'];

        if($numTickets > ($tickettype->maxPerUser - $previous_tickets))
            return "Too many tickets ordered. This is not possible";
        
        for($i=1;$i<=$numTickets;$i++) {
            $t = new Ticket;
            $t->ticketType = $tickettype->id;
            $t->owner = auth()->user()->id;
            $t->status = 'unpaid';
            $t->save();
        }
        return redirect()->route('events.signup', ['event' => $event->slug]);
    }
}
