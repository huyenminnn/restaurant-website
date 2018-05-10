<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use Yajra\Datatables\Datatables;
use Auth;

class PageController extends Controller
{

    /**
     * display interface
     * @return [type] [description]
     */
    public function getSlider()
    {
        $admin_info = Auth::guard('admin')->user();
    	return view('admin.pages.slider',[
            'admin_info' => $admin_info,
        ]);
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


    /**
     * delete an imgae from slide
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroyImage($id)
    {
    	Slider::find($id)->delete();
    	return response()->json(['done']);
    }


    /**
     * save an image-slide to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function storeImage(Request $request)
    {
        $data = $request->all();
        $date = date('YmdHis', time());
        $slide = array(
            'title' =>$request->all()['title'],
            'description' =>$request->all()['description'],
            'status' =>$request->all()['status'],
        );
        
        if ($request->hasFile('thumbnail')) {

            $extension = '.'.$data['thumbnail']->getClientOriginalExtension();

            $file_name = md5($request->name).'_'. $date . $extension;

            $data['thumbnail']->storeAs('public/sliders',$file_name);

            $slide['image'] = 'storage/sliders/'.$file_name;

        }else {
            // $imageName='posts/userDefault.png';
        }
        $slider = Slider::create($slide);
        
        return $slider;
    }

    /**
     * diaplay interface about-us content management
     * @return [type] [description]
     */
    public function getAboutUs()
    {
        $admin_info = Auth::guard('admin')->user();
        return view('admin.pages.aboutUs',[
            'admin_info' => $admin_info,
        ]);
    }
}
