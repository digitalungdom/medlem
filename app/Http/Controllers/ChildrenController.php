<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ChildrenController extends Controller
{

    public function __construct() {
        
        //if(!auth()->user()->is_parent) abort(403, "Ikke foresatt!");
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('children.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = auth()->user();
        return view('children.create')->with('user', $user);
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
        $userData = $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'cellphone' => 'nullable|unique',
            'email' => 'nullable|unique',
            'birthday' => 'required|date',
            'address' => 'required',
            'postnumber' => 'exists:postnumber,postNummer',
            'gender' => 'in:male,female,other'
        ]);
        
        $user = new User;
        
        $user->firstname = $userData['firstname'];
        $user->lastname = $userData['lastname'];
        $user->cellphone = $userData['cellphone'];
        $user->birthday = $userData['birthday'];
        $user->address = $userData['address'];
        $user->postnumber = $userData['postnumber'];
        $user->gender = $userData['gender'];
        $user->self_verified_at = Carbon::now();
        $user->password = Str::random(30);
        $user->email = $userData['email'];
        $user->parent = auth()->user()->id;
        $user->save();

        return redirect('children.index')->status($user->firstname. " har blitt lagt inn som barnet ditt");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
