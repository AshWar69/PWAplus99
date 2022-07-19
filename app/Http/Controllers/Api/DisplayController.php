<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Company;
use App\Models\Order;
use App\Models\Pmodel;
use App\Models\Product;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = Category::where('status','Y')->get();
        return response()->json(['status'=>200, 'msg'=>'Data Found', 'Data'=>$cat]);
    }
    
    public function fetchSingleCat($id)
    {
        $cat = Category::where('parent_id',$id)->where('active','Y')->get();
        return response()->json(['status'=>200, 'msg'=>'Data Found', 'Data'=>$cat]);
    }

    public function getBanners()
    {
        $ban = Banner::where('active','Y')->get();
        return response()->json(['status'=>200, 'msg'=>'Data Found', 'Data'=>$ban]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $comp = Company::where('cat_id',$id)->where('status','Y')->get();
        return response()->json(['status'=>200, 'msg'=>'Data Found', 'Data'=>$comp]);
    }

    public function fetchModel($cid, $cat_id)
    {
        $mod = Pmodel::where('cat_id',$cat_id)->where('cid',$cid)->where('active','Y')->get();
        return response()->json(['status'=>200, 'msg'=>'Data Found', 'Data'=>$mod]);
    }

    public function fetchProduct($mid)
    {
        $pro = Product::where('model',$mid)->where('status','Y')->get();
        return response()->json(['status'=>200, 'msg'=>'Data Found', 'Data'=>$pro]);
    }

    public function addCart(Request $request)
    {
        $cart = new Cart();
        $cart->pid = $request->pid;
        $cart->uid = $request->uid;
        $cart->price = $request->price;
        $cart->quantity = $request->quantity;

        if($cart->save())
            return response()->json(['status'=>200, 'msg'=>'Products Added To Your Cart Successfully']);
        else
            return response()->json(['status'=>200, 'msg'=>'Error Occured']);
    }
    
    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->pid = $request->pid;
        $order->uid = $request->uid;
        $order->price = $request->price;
        $order->quantity = $request->quantity;
        $order->tprice = $request->tprice;
        $order->payment_mode = $request->payment_mode;

        if($order->save())
            return response()->json(['status'=>200, 'msg'=>'Order Placed Successfully']);
        else
            return response()->json(['status'=>200, 'msg'=>'Error Occured']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
