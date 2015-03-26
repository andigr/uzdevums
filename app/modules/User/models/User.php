<?php namespace App\Modules\User\Models;

class User extends \Eloquent {

	public $timestamps = false;

	protected $table = 'users';

	protected $fillable = ['name', 'surname', 'email', 'password'];

	protected $hidden = ['password', 'remember_token'];

}