<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;

class PageController extends Controller
{
    public function getSlider()
    {
    	return view('admin.pages.slider');
    }

    /**
     * get data from db and display in view
     * using Laravel-DataTable
     * @return [type] [description]
     */
    public function anyData()
    {
    	$list = Slider::all();
    	
    	return Datatables::of($list)
        ->addColumn('action', function ($product) {
            return '</a>&nbsp;<a name="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$product["id"].'></a>&nbsp;<a name="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$product["id"].'></a>';
        })
        ->setRowId('id')
        ->make(true);
    }

    public function destroyImage($id)
    {
    	Slider::find($id)->delete();
    	return respone()->json(['done']);
    }
}
