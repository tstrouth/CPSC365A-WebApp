<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class ResponseDB extends Eloquent {

    use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Responses';

	public $timestamps = false;

	protected $primaryKey = 'id';

  public function data(){
    return $this->hasMany("ResponseData", "response_fkey", "id");
  }

}
