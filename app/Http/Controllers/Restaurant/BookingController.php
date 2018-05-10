<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Booking;
use App\BookingDetails;

class BookingController extends Controller
{
	/**
	 * add an Food in booking list
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function bookProduct($id)
	{
		// \Cart::destroy();
		$product = Product::find($id);
		$rows = \Cart::content();
		/**
		 * $rows : COLLECTION type
		 * $cartItem: call item in Collection
		 * $rowId: field returned, use($id): using $id to be parameter
		 * @var [type]
		 */
		$rowId = $rows->search(function($cartItem, $rowId) use($id) {
			return ($cartItem->id == $id);
		});

		if ($rowId!=false) {  
			
			$item = \Cart::get($rowId);
			
			return \Cart::update($rowId, $item->qty+1);

		} else {
			return \Cart::add($id, $product['name'], 1, $product['price'], ['thumbnail' => $product['thumbnail'],
				'origin_price' =>$product['origin_price'],
			]);
		}    	
	}

	/**
	 * get list food and drink 
	 * @return [type] [description]
	 */
	public function getBookList()
	{
		$list = \Cart::content();
		// dd($list);
		return view('restaurant.pages.bookingList',[
			'list'=>\Cart::content(),
			'count' => \Cart::count(),
			'total' => \Cart::total(),
			'tax' => \Cart::tax(),
		]);
	}

	/**
	 * increase quantity of food/ drink
	 * @param  Request $request [description]
	 * @return food/drink has been updated
	 */
	public function increase($rowId)
	{		
		$item = \Cart::get($rowId);	
		$product = Product::find($item->id);	
		return array(
			'item'=> \Cart::update($rowId,  [
				'qty'=>$item->qty+1,
				'thumbnail' => $product['thumbnail'],
				'origin_price' =>$product['origin_price']
			]),
			'total'=> \Cart::total(),
			'tax' =>\Cart::tax()
		);
	}

	/**
	 * decrease quantity of food/ drink
	 * @param  Request $request [description]
	 * @return food/drink has been updated
	 */
	public function decrease($rowId)
	{		
		$item = \Cart::get($rowId);
		if ($item->qty==1) {
			return array(
				'item'=>\Cart::remove($rowId),
				'total' => \Cart::total(),
				'tax' => \Cart::tax(),
			);
		} else {
			$product = Product::find($item->id);	
			return array(
				'item'=> \Cart::update($rowId,  [
					'qty'=>$item->qty-1,
					'thumbnail' => $product['thumbnail'],
					'origin_price' =>$product['origin_price']
				]),
				'total'=> \Cart::total(),
				'tax' =>\Cart::tax()
			);
		}		
	}


	/**
	 * save booking 's information to db'
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function booking(Request $request)
	{
		// \Cart::destroy();
		$data = $request->all();
		$rows = \Cart::content();
		if ($rows->count()==0) {
			$data['total']=0;
			Booking::create($data);			
		} else {
			$data['total']=\Cart::total();
			$booking = Booking::create($data);
			foreach ($rows as $item) {
				$data =[
					'booking_id' => $booking['id'],
					'product_id' => $item->id,
					'quantity' => $item->qty,
					'price' => $item->price,
				];
				BookingDetails::create($data);
			}
		}
		\Cart::destroy();
		return redirect()->route('restaurant.home');
	}
}
