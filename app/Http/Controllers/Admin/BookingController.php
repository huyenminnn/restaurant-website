<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Booking;
use App\BookingDetails;
use App\Product;

class BookingController extends Controller
{
	public function getIndex()
	{
        $admin_info = \Auth::guard('admin')->user();
		return view('admin.booking.index',[
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
    	$list = Booking::all();
    	
    	return Datatables::of($list)
    	->addColumn('action', function ($booking) {
    		return '<a name="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'.$booking["id"].'" id="row-'.$booking["id"].'"></a>&nbsp;<a name="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$booking["id"].'></a>&nbsp;<a name="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$booking["id"].'></a>';
    	})
    	->setRowId('id')
    	->make(true);
    }

    /**
     * delete Booking by ID
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
    	Booking::find($id)->delete();
    	return response()->json(['done']);
    }


    /**
     * save an booking into db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
    	$data = $request->all();
    	$data['status'] = '1';
    	return Booking::create($data);
    }


    /**
     * get booking detail by id
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBookingDetail($id)
    {
        return Product::join('bookingdetails', 'products.id','=', 'bookingdetails.product_id')->where('bookingdetails.booking_id','=',$id)->get();
    }
}
