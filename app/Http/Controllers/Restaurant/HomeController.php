<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	/**
	 * display index page/ home
	 * @return [type] [description]
	 */
    public function getIndex()
    {
    	return view('restaurant.index');
    }


    /**
     * display information about group
     * @return [type] [description]
     */
    public function getAboutUs()
    {
    	return view('restaurant.pages.aboutUs');
    }

    /**
     * display information to contact
     * @return [type] [description]
     */
    public function getFormBooking()
    {
    	return view('restaurant.pages.booking');
    }
}
