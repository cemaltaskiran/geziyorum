<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Ban;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'birthdate', 'password', 'name_surname', 'bio', 'location', 'media_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function createdTrips()
    {
        return $this->hasMany('App\Trip');
    }

    public function joinedTrips()
    {
        return $this->belongsToMany('App\Trip', 'user_trip', 'user_id', 'trip_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function bans()
    {
        return $this->hasMany('App\Ban', 'banable_id');
    }

    /**
     * @param string|array $roles
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
            abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
        abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    
    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function media(){
        return $this->belongsTo('App\Media');
    }

    public function getPhoto(){
        if($this->photo_path !== NULL){
            return '/storage/pp/'.$this->photo_path;
        }
        return '/storage/pp/non.png';
    }

    public function isUserComplained($id, $type){
        $query = DB::table('reports')->where([
            ['complaintable_id', '=', $id],
            ['complaintable_type', '=', $type],
            ['user_id', '=', $this->id],
        ])->get();

        if(count($query) > 0){
            return true;
        }
        return false;
    }

    public function getBan(){

        $ban = Ban::where([
            ['banable_id', '=', $this->id],
            ['banable_type', '=', 'user'],
            ['timeout', '>', date('Y-m-d H:i:s')]
        ])->orderBy('timeout', 'desc')->first();
            
        return $ban;
    }

    public function hasBan(){
        if($this->getBan() == null){
            return false;
        }
        return true;
    }

}
