<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Category extends Eloquent implements UserInterface, RemindableInterface {

	public $timestamps = false;

	protected $fillable = ['parent_id', 'name', 'description', 'hidden_fields', 'displayed_fields'];

	protected $primaryKey = 'id';  // IS THIS FIELD NECESSARY?


	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	public static $messages;

	public static $rules = [
		'parent_id'=>'required|numeric',
		'name'=>'required'
	];

	public static function isValid($dataToBeValidated)
	{
		$v = Validator::make($dataToBeValidated, static::$rules);

		if($v->passes())
		{
			return true;
		}

		static::$messages = $v->messages();
		return false;
	}

}
