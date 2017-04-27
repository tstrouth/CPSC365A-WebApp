<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ResponseData extends Eloquent {
    use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ResponseData';

	public $timestamps = false;

	protected $primaryKey = 'ID';

}
