<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Admin;
use App\Post;
use Auth;

class AdminController extends Controller
{
	/**
	 * [adminIndex display view of list admin]
	 * @return [type] [description]
	 */
	public function adminIndex()
	{
		// $admin_infor = Auth::guard('admin')->user();
		// dd($admin_infor);
		//return view('admin.admins.index');
		$admin = Admin::all();
 		return view('admin.admins.index');
	}

	/**
	 * [datatablesListAdmin get list admin and display into the table]
	 * @return [type] [description]
	 */
	public function getListUserDatatables()
	{
		$list = Admin::all();
		
		return Datatables::of($list)
		->addColumn('action', function ($admin) {
			 return '<a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-admin-id='.$admin["id"].'" id="row-'.$admin["id"].'"></a><a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-admin-id='.$admin["id"].'></a><a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-admin-id='.$admin["id"].'></a>';
			
		})
		->setRowId('id')
        ->make(true);
	}

	
	public function adminUserStore(Request $request)
	{
		$data = $request->all();
		$admins =  Admin::create($data);
		if ($admins!=null) {			
			return $admins;
		} else {
			return response()->json(['done']);
		}
	}

	public function adminUserDelete($id)
	{
		Admin::find($id)->delete();
		return response()->json(['done']);
	}

	public function adminUserShow($id)
	{
		$admins = Admin::where('id','=',$id)->first();
		return $admins;
	}
}
