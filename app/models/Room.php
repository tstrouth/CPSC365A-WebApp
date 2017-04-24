<?php

class Room extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Rooms';

	public $timestamps = false;

	protected $primaryKey = 'id';

}
