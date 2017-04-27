<?php

class User extends Eloquent {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Users';

	public $timestamps = false;
	protected $primaryKey = 'ID';

	public function type(){
    return $this->hasOne("UserType", "ID", "user_type");
  }

}
