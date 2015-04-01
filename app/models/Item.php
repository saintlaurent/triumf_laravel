<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Item extends Eloquent implements UserInterface, RemindableInterface {

	public $timestamps = false;

	protected $fillable = ['barcode', 'kind_id', 'category_id', 'owner', 'current_location',
        'serial_number', 'po_number', 'cfi', 'requisitioner', 'received', 'warranty_until',
        'calibration_until', 'ip', 'mac', 'boothost', 'machine_name', 'asset_number',
        'created_on', 'updated_on', 'use', 'status', 'individual_price', 'quantity', 'total_price',
        'manufacturer', 'slots', 'features', 'user', 'normal_location', 'model', 'description_too',
        'color_of_surface'];

	protected $primaryKey = 'id';  // IS THIS FIELD NECESSARY?


	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'items';

	public static $messages;

	public static $rules = [
		'kind_id'=>'required|numeric',
		'category_id'=>'required|numeric'
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
