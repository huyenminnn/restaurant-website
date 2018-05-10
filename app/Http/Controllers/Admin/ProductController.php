<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Yajra\Datatables\Datatables;
use Validator;

class ProductController extends Controller
{
	/**
	 * display interface admin Product
	 * @return [type] [description]
	 */
    public function getIndex()
    {
        $admin_info = \Auth::guard('admin')->user();
    	$categories = Category::where('has_sub_cate','=',0)->get();
    	return view('admin.products.index',[
    		'categories' => $categories,
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
    	$list = Product::all();
    	foreach ($list as $product) {
    		$product['category_name'] = Category::find($product['category_id'])['name'];
    	}
    	return Datatables::of($list)
        ->addColumn('action', function ($product) {
            return '<a name="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'.$product["id"].'" id="row-'.$product["id"].'"></a>&nbsp;<a name="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$product["id"].'></a>&nbsp;<a name="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$product["id"].'></a>';
        })
        ->setRowId('id')
        ->make(true);
    }

    /**
     * create an product and save to db
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $date = date('YmdHis', time());

        // $rules = [
        //     'name' => 'required',
        //     'description' => 'required',
        //     'content' => 'required',
        //     'category_id' => 'required',
        //     'thumbnail' => 'mimes:jpeg,png,jpg',
        // ];

        // $messages = [
        //     'name.required' => 'The name is required!',
        //     'description.required' => 'The description is required!',
        //     'content.required' => 'The content is required!',
        //     'category_id.required' => 'The category is required!',
        //     'thumbnail.mimes' => 'The thumbnail must have extension: (jpg, jpeg, png)!',
        // ];

        // $validator = Validator::make($data, $rules, $messages);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator);
        // }


        if ($request->hasFile('thumbnail')) {

            $extension = '.'.$data['thumbnail']->getClientOriginalExtension();

            $file_name = md5($request->name).'_'. $date . $extension;

            $data['thumbnail']->storeAs('public/products',$file_name);

            $data['thumbnail'] = 'storage/products/'.$file_name;

        }else {
            // $imageName='posts/userDefault.png';
        }

        $data['slug'] = str_slug($request->name);

        $product = Product::create($data);
        $product['category_name'] = Category::find($product['category_id'])['name'];

        return $product;
    }

    /**
     * display information of product has id = parameter id
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $product = Product::find($id);
        $product['category_info'] = Category::find($product['category_id']);
        return $product;
    }

    /**
     * get product detail and display in form Edit
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $product['category_info'] = Category::find($product['category_id']);
        return $product;
    }

    /**
     * update new information about product
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $data= $request->all();
        // $data =  array(
        //     'name' => $request->input('name'),
        //     'origin_price' => $request->input('origin_price'),
        //     'price' => $request->input('price'),
        //     'description' => $request->input('description'),
        //     'content' => $request->input('content'),
        //     'category_id' => $request->input('category_id'),
        // );
        $date = date('YmdHis', time());
        
        if ($request->hasFile('thumbnail')) {

            $extension = '.'.$data['thumbnail']->getClientOriginalExtension();

            $file_name = md5($request->name).'_'. $date . $extension;

            $data['thumbnail']->storeAs('public/products',$file_name);

            $data['thumbnail'] = 'storage/products/'.$file_name;
        } else {
            $data['thumbnail'] = Product::find($id)['thumbnail'];
        }

        $data['slug'] = str_slug($request->name);
        $data['status']=1;

        $product = Product::find($id);

        return $product;
    }


    /**
     * delete product by id
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json(['done']);
    }
}
