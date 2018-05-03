<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	protected $fillable = ['name', 'slug', 'description', 'parent_id', 'level', 'has_sub_cate'];

	public static function sub_cate($id)
	{
		return Category::where('parent_id','=',$id)->get();
	}

}
