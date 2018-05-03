<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
	/**
 	* Displays datatables front end view
 	*
 	* @return \Illuminate\View\View
 	*/
 	public function getIndex()
 	{
 		$categories = Category::where('level','<',3)->get();
 		return view('admin.categories.index',[
 			'categories' => $categories,
 		]);
 	}

	/**
	 * Process datatables ajax request, always go with getIndex when using DataTable
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function anyData()
	{
		$list = Category::all();
		foreach ($list as $category) {
			$parent = Category::find($category['parent_id']);
			if($parent!=null){
				$category['parent'] = $parent['name'];
			} else {
				$category['parent'] = ['No super category'];
			}
			
		}
		return Datatables::of($list)
		->addColumn('action', function ($category) {
			return '<a title="Detail" class="btn btn-info btn-sm glyphicon glyphicon-eye-open btnShow" data-id="'.$category["id"].'" id="row-'.$category["id"].'"></a>&nbsp;<a title="Update" class="btn btn-warning btn-sm glyphicon glyphicon-edit btnEdit" data-id='.$category["id"].'></a>&nbsp;<a title="Delete" class="btn btn-danger btn-sm glyphicon glyphicon-trash btnDelete" data-id='.$category["id"].'></a>';
		})
		->setRowId('id')
		->make(true);
	}

	/**
	 * save new category to db
	 * @param Request $request [description]
	 */
	public function store(Request $request)
	{
		$data = $request->all();
		$data['slug'] = str_slug($data['name']);
		$data['level']+=1;

		if ($request->parent_id!=0) {
			Category::find($request->parent_id)->update(['has_sub_cate'=>true]);
		}

		$category =  Category::create($data);
		if ($category!=null) {
			$category['parent'] = Category::find($category['parent_id'])['name'];
			return $category;
		} else {
			return response()->json(['done']);
		}
	}

	/**
	 * delete category by ID
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function destroy($id)
	{
		Category::find($id)->delete();
		return response()->json(['done']);
	}

	/**
	 * get data of category by ID
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function show($id)
	{
		$category= Category::where('id','=',$id)->first();
		if ($category['parent_id']==0) {
			$category['parent'] = "No super category";
		} else {
			$category['parent'] = Category::where('id', "=",$category['parent_id'])->first()['name'];
		}		
		return $category;
	}

	/**
	 * edit category by ID
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function edit($id)
	{
		$cate= Category::find($id);
		if ($cate['parent_id']==0) {
			$cate['parent'] = "Select super category";
		} else {
			$cate['parent'] = Category::where('id', "=",$cate['parent_id'])->first()['name'];
		}		
		return $cate;
	}


	/**
	 * update cate by ID
	 * @param  Request $request get data from form
	 * @param  [type]  $id     	cate was update
	 * @return [type]           cate has been updated
	 */
	public function update(Request $request, $id)
	{
		$data = $request->all();
		$data['slug'] = str_slug($data['name']);

		if ($request->parent_id==0) {
			$data['level']=1;
		} else {
			$parent = Category::where('id','=',$request->parent_id)->first();
			$data['level'] = $parent['level']+1;
		}
		
		Category::find($id)->update($data);

		$category = Category::find($id);

		if ($category!=null) {
			if ($category['parent_id']==0) {
				$category['parent']="No super category";
			} else {
				$category['parent'] = Category::where('id', "=",$category['parent_id'])->first()['name'];
			}
			return $category;
		} else {
			return response()->json(['error' => 'Updated fail', 200]);
		}
	}

}
