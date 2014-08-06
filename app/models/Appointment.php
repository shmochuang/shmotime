<?php

class Appointment extends Eloquent {

	# The guarded properties specifies which attributes should *not* be mass-assignable
	protected $guarded = array('id', 'created_at', 'updated_at');
	
	# Link to users table
	public function user() {
		
		#this appointment belongs to one user
		return $this->belongsTo('User');
	}
}