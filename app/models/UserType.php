<?php

class UserType extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'UserTypes';

	public $timestamps = false;
	protected $primaryKey = 'id';

}
