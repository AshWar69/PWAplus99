<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmMail;
use App\Mail\OrderMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Company;
use App\Models\Order;
use App\Models\Pmodel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::all();
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
        , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();

        return view('pages.frontend.index', compact('categories', 'products', 'cart', 'count'));
    }

    public function showCompany($id)
    {
        $companies = Company::where('cat_id', $id)->get();
        $products = Product::where('category', $id)->get();
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
        , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();

        return view('pages.frontend.category', compact('companies', 'products','cart','count'));
    }

    public function showModel($id)
    {
        $mod = Pmodel::where('cid', $id)->count();
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
        , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();
        if ($mod > 0) {
            $models = Pmodel::where('cid', $id)->get();
            $products = Product::where('company', $id)->get();
            return view('pages.frontend.company', compact('models', 'products','cart','count'));
        } else {
            $products = Product::where('model', 0)->where('company',$id)->get();
            return view('pages.frontend.product', compact('products','cart','count'));
        }
    }

    public function showProduct($id)
    {
        $products = Product::where('model', $id)->get();
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
        , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();
        return view('pages.frontend.product', compact('products','cart','count'));
    }

    public function showProductInfo($id)
    {
        $products = Product::select('products.*', 'categories.name as cname')->join('categories', 'products.category', '=', 'categories.id')
            ->where('products.id', $id)->first();
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
            , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();
        
        return view('pages.frontend.productinfo', compact('products','cart','count'));
    }
    
    public function showCart()
    {
        // $products = Product::select('products.*', 'categories.name as cname')->join('categories', 'products.category', '=', 'categories.id')
        //     ->where('products.id', $id)->first();
        $cartDetails = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
            , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
            , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();
        
        return view('pages.frontend.cart', compact('cart','count','cartDetails'));
    }
    
    public function showCheckout()
    {
        // $products = Product::select('products.*', 'categories.name as cname')->join('categories', 'products.category', '=', 'categories.id')
        //     ->where('products.id', $id)->first();
        $cartDetails = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
            , products.name as pname, products.quantity as pquan, companies.name as company_name, pmodels.name as mod_name ")
            ->join('products', 'carts.pid', '=', 'products.id')->join('companies', 'products.company', '=', 'companies.id')
            ->join('pmodels', 'products.model', '=', 'pmodels.id')->where('uid', Auth::user()->id)->groupBy('pid')->get();
            
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
            , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();
        
        return view('pages.frontend.checkout', compact('cart','count','cartDetails'));
    }

    public function addCart(Request $request)
    {
        $id = Auth::user()->id;
        $oldCart = Cart::where('pid', $request->pid)->where('uid', $id)->first();
        if (!empty($oldCart)) {
            $oldCart->quantity += $request->quantity;
            if ($oldCart->save())
                echo "Product Added To Your Cart Successfully";
            else
                echo "Error Occured";
        } else {
            $cart = new Cart();
            $cart->pid = $request->pid;
            $cart->uid = $id;
            $cart->price = $request->price;
            $cart->quantity = $request->quantity;

            if ($cart->save())
                echo "Product Added To Your Cart Successfully";
            else
                echo "Error Occured";
        }
    }

    public function saveOrder(Request $request)
    {
        $quan = $request->quantity;
        $amnt = $request->price;
        $pname = $request->pname;
        $oquan = $request->orderq;
        $com = $request->com;
        $mod = $request->model;
        $c = count($request->pname);
        
        $order = new Order();
        $order->uid = Auth::id();
        $order->add1 = $request->add1;
        $order->add2 = $request->add2;
        $order->pmob = $request->pmob;
        $order->city = $request->city;
        $order->pincode = $request->pin;
        $order->payment_mode = $request->pay;

        $sr = 1; $odetails='';
        for($i=0; $i < $c; $i++) {
            $odetails .= $sr.") Company:- ".$com[$i]." Model:- ".$mod[$i]." Product:- ".$pname[$i]." x".$quan[$i]."pcs x".$oquan[$i]." ₹".$amnt[$i].", ";
            $sr++;
        }
        $order->order_details = $odetails;
        $order->tax = $request->tax;
        $order->taxamount = $request->taxval;
        $order->price = $request->sub;
        $order->tprice = $request->tprice;
            
            if ($order->save()) {
                    echo "Order Placed Successfully";
                    Mail::to('ashank970@gmail.com')->send(new OrderMail());
                    Mail::to(Auth::user()->email)->send(new OrderConfirmMail());
                    //return response()->json(['status' => 200, 'msg' => 'Order Placed Successfully']);
                } else
                    echo "Error";
                    //return response()->json(['status' => 200, 'msg' => 'Error Occured']); shop337786@gmail.com
        

    }

    public function showOrder()
    {
        $order = Order::where('uid',Auth::id())->where('status','Pending')->orderBy('id','desc')->first();
        $cart = Cart::selectRaw("carts.id as cid, uid, sum(carts.quantity) as quan, sum(carts.price) as price
            , products.name as pname, image, products.quantity as pquan")->join('products', 'carts.pid', '=', 'products.id')
            ->where('uid', Auth::user()->id)->groupBy('pid')->get();
        $count = Cart::selectRaw("count(carts.id) as count")->where('uid', Auth::user()->id)->first();

        $cartd = Cart::where('uid',Auth::id())->delete();
        
        return view('pages.frontend.order', compact('cart','count','order'));
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
        //
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
    public function update(Request $request)
    {
        $c = count($request->cart);
        $car = $request->cart;
        $quan = $request->quantity;
        for($i=0; $i < $c; $i++){
            $cart = Cart::find($car[$i]);
            $cart->quantity = $quan[$i];
            if($cart->save())
                echo "Product Quantity Updated";
            else
                echo "Error Occured";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delCart = Cart::find($request->rid);
        if($delCart->delete())
            echo "Product Removed From Cart";
        else
            echo "Error Occured";
    }
}
