<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
	public function getIndex()
	{
		$admin_info = Auth::guard('admin')->user();
		return view('admin.index', ['admin_info' => $admin_info]);
	}

}
