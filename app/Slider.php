<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = ['image','title', 'description','status'];

    /**
     * get slide to display into restaurant
     * @return [type] [description]
     */
    public static function getSlide()
    {
    	return Slider::where('status','=',1)->latest()->take(3)->get();
    }
}
