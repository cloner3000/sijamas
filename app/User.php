<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public $guarded = ['verify_password'];

	public function roles()
    {
        return $this->hasMany(new Role);
    }

	public function rules($id="")
    {

        if(!empty($id))
        {
            $email = ',email,'.$id;
            $username = ',username,'.$id;
        }else{
            $email = '';
            $username = '';
        }

        return [
            'name'      => 'required|max:200',
            'email'     => 'required|email|unique:users'.$email,
            'password'  => 'required',
            'verify_password'   => 'required|same:password',
            // 'role_id'   => 'required',
            'username'  => 'required|unique:users'.$username,
        ];
    }
}
