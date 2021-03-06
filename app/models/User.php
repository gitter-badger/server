<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	protected $fillable = ['email', 'username', 'name_first', 'name_last', 'active', 'quota'];

	/**
	 * The active attribute return boolean true instead of mysql 1
	 *
	 * @param $value
	 * @return bool
	 */
	public function getActiveAttribute($value)
	{
		if ($value == 1) {
			return true;
		}

		return false;
	}

	public function getQuotaAttribute($value)
	{
		return (int) $value;
	}

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	public function photos()
	{
		return $this->hasMany('Photo');
	}

}
