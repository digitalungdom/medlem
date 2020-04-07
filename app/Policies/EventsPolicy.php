<?php

namespace App\Policies;

use App\Events;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any events.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the events.
     *
     * @param  \App\User  $user
     * @param  \App\Events  $events
     * @return mixed
     */
    public function view(User $user, Events $events)
    {
        //
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        if($user->can('events')) {
            return true;
        }

    }

    /**
     * Determine whether the user can update the events.
     *
     * @param  \App\User  $user
     * @param  \App\Events  $events
     * @return mixed
     */
    public function update(User $user, Events $events)
    {
        //
        if($user->can('events')) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the events.
     *
     * @param  \App\User  $user
     * @param  \App\Events  $events
     * @return mixed
     */
    public function delete(User $user, Events $events)
    {
        //
        if($user->can('events')) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the events.
     *
     * @param  \App\User  $user
     * @param  \App\Events  $events
     * @return mixed
     */
    public function restore(User $user, Events $events)
    {
        //
        if($user->can('events')) {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the events.
     *
     * @param  \App\User  $user
     * @param  \App\Events  $events
     * @return mixed
     */
    public function forceDelete(User $user, Events $events)
    {
        //
        if($user->can('events')) {
            return true;
        }
    }
}
