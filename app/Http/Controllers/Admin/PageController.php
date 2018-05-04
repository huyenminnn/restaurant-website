<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Yajra\Datatables\Datatables;

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

    public function storeImage(Request $request)
    {
        $data = $request->all();
        $data['hidden'] = 0;

        if ($request->hasFile('thumbnail')) {

            $extension = '.'.$data['image']->getClientOriginalExtension();

            $file_name = md5($request->name).'_'. $date . $extension;

            $data['image']->storeAs('public/sliders',$file_name);

            $data['image'] = 'storage/sliders/'.$file_name;

        }else {
            // $imageName='posts/userDefault.png';
        }
        $slider = Slider::create($data);
        return $slider;
    }
}
