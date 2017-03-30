<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
	 /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$search=$request->get('name');
    	$paginate=true;

    	if($search)
    	{	$paginate=false;
    		$products=Product::where('name','LIKE',"%$search%")->get();
    	}else
    	{
    		$products=Product::orderBy('id','DESC')->paginate(5);
		}
        return view('Backend.products.index',compact('products','paginate'));
    }
}
