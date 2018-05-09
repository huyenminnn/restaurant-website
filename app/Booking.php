<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

	protected $fillable = ['name', 'phone', 'email', 'address', 'number_of_guess', 'date', 'time', 'message','status', 'total'];
}
