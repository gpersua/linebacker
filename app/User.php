<?php

namespace linebacker;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Eloquent;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

class User extends Model implements AuthenticatableContract,
                                    CanResetPasswordContract,
                                    HasRoleAndPermissionContract
{
    use Authenticatable, CanResetPassword,  HasRoleAndPermission;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lb_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'confirmed' , 'in_active', 'confirmation_code'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    /*filter*/
    public function scopeFilter($query, $name)
    {
	if(trim($name)!=""){
		$query->where('name', 'LIKE', "%$name%");
	}
    }

	/*new user*/
	public static $new = array(
		'name' => 'required|min:6',
		'email' => 'required|email|unique:lb_users',
		'password' => 'required|confirmed|min:6|max:30',
		"password_confirmation" => "required|alpha_dash|min:6|max:30"
	);

	/*edit user*/
	public static $edit = array(
		'name' => 'required|min:6',
		'email' => 'required|email',
		'password' => 'required|confirmed|min:6|max:30',
		"password_confirmation" => "required|alpha_dash|min:6|max:30"
	);

	/*destroy user*/
	public static $destroy = array(
		'id' => 'required|integer'
	);
}
