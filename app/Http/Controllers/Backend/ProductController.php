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
            \Cache::put('data',$products,90);
    	}else
    	{
    		$products=Product::orderBy('id','DESC')->paginate(5);
		}
        return view('Backend.products.index',compact('products','paginate'));
    }

    public function pdf()
    {
        $products=\Cache::get('data');
        $pdf = \PDF::loadView('Backend.products.pdf', compact('products'));

        return $pdf->download('listado.pdf');
    }

    public function xls()
    {
        \Excel::create('listado',function($excel){
            $excel->sheet('Sheetname',function($sheet){
                $sheet->setOrientation('landscape');
                $sheet->fromArray(\Cache::get('data'));
            });
        })->download('xls');
    }

}
