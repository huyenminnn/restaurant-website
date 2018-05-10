<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Booking;
use App\Slider;
use Validator;

class HomeController extends Controller
{
	/**
	 * display index page/ home
	 * @return [type] [description]
	 */
    public function getIndex()
    {
        $rows = \Cart::content();
        $items = $rows->count();
        $slides = Slider::getSlide();
    	return view('restaurant.index',[
            'items'=>$items,
            'slides' => $slides,
        ]);
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

    /**
     * display list Food
     * @return [type] [description]
     */
    public function getFood()
    {
        $food_id = '1';
        $cates = Category::sub_cate($food_id);
        $cate_list= [];
        foreach ($cates as $cate) {
            if ($cate['has_sub_cate']==0) {
                $cate_list[] = $cate;
            } else {
                $sub_cate_1 = Category::sub_cate($cate['id']);
                foreach ($sub_cate_1 as $sub_cate) {
                    $cate_list[] = $sub_cate;
                }
            }
        }
        // dd($cate_list);
        $category_id_list = [];
        foreach ($cate_list as $cate) {
            $category_id_list[] = $cate['id'];
        }

        $food_list = Product::whereIn('category_id',$category_id_list)->paginate(9);
        // dd($food_list);
        return view('restaurant.pages.food', [
            'food_list' => $food_list,
        ]);
    }


    /**
     * display drink list
     * @return [type] [description]
     */
    public function getDrink()
    {
        $food_id = '2';
        $cates = Category::sub_cate($food_id);
        $cate_list= [];
        foreach ($cates as $cate) {
            if ($cate['has_sub_cate']==0) {
                $cate_list[] = $cate;
            } else {
                $sub_cate_1 = Category::sub_cate($cate['id']);
                foreach ($sub_cate_1 as $sub_cate) {
                    $cate_list[] = $sub_cate;
                }
            }
        }
        // dd($cate_list);
        $category_id_list = [];
        foreach ($cate_list as $cate) {
            $category_id_list[] = $cate['id'];
        }

        $drink_list = Product::whereIn('category_id',$category_id_list)->paginate(6);
        // dd($food_list);
        return view('restaurant.pages.drink', [
            'drink_list' => $drink_list,
        ]);
    }
}
