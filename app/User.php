<?php

namespace App;

use App\Http\Controllers\MembershipController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Membership;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','firstname','lastname','cellphone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = array('FullName','IsMember');




    public function memberships() {
        return $this->hasMany(Membership::class);
    }

    public function getFullNameAttribute() {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function getIsMemberAttribute() {
        $membership = Membership::where('user_id', '=', $this->id)->whereDate('stopTime', '>=',Carbon::today()->toDateString())->get();
        if($membership->count() > 0) return true;
        else return false;
    }
    public function getAgeAttribute() {
        return Carbon::parse($this->birthday)->diff(Carbon::now())->format('%y');
    }

    public function getValidMembershipTypes() {
        if($this->age) {
            return \App\MembershipType::where('maxAge','>=',$this->age)->orWhere('minAge','<=',$this->age)->get();
        }

    }

    public function isMember($user = NULL,$date = NULL) {
        if($date == NULL) $date = Carbon::now();
        else $date = Carbon::parse($date);
        if($user == NULL) $user = Auth::user();
        else $user = User::findOrFail($user);

        $member = Membership::where('user_id', $user->id)
            ->where('startTime', '<=', $date)
            ->where('stopTime', '>=', $date)
            ->get();
        if(count($member) > 0)
            return true;
        return false;

    }
}
