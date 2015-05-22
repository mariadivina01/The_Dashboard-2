<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model {

	protected $table = 'flags';
	//
	public function user(){

		return $this->HasOne('App\User');

	}

	public function posts(){
		
		return $this->belongsTo('App\Post');
	}

}
