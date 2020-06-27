<?php

namespace App\Http\Controllers;

use App\MembershipType;
use Illuminate\Http\Request;

class MembershipTypeController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:roles');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('membershipType', MembershipType::class);
        $membershipType = MembershipType::all();
        return view('membershipType.index',compact('membershipType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('membershipType', MembershipType::class);
        return view('membershipType.create');
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
        $this->validate($request, [
            'name' => 'required|unique:membership_types,name',
            'maxAge' => 'nullable|integer',
            'minAge' => 'nullable|integer',
            'price' => 'required|integer',
            'hidden' => 'boolean',
        ]);
        $type = MembershipType::create(['name' => $request->input('name'), 'minAge' => $request->input('minAge'), 'maxAge' => $request->input('maxAge'), 'price' => $request->input('price'), 'hidden' => $request->input('hidden')]);
        return redirect()->route('membershipType.index')->with('success', 'Medlemsskapstype opprettet');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipType $membershipType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipType $membershipType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MembershipType $membershipType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembershipType  $membershipType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipType $membershipType)
    {
        //
    }

    public function adminindex() {
        $this->authorize('membershipType', MembershipType::class);

    }
}
