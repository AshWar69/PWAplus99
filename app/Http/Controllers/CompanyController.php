<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Company;
use App\Models\Pmodel;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $com = Company::select('companies.*', 'categories.name as cat_name')
            ->join('categories', 'companies.cat_id', '=', 'categories.id')->where('companies.cat_id', $id)->get();
        $i = 1;
        return view('pages.company.companies', compact('com', 'i','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('pages.company.company', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $com = new Company();
        $com->name = $request->cname;
        $com->cat_id = $request->cat_id;
        if ($request->hasFile('cimg')) {
            $file = $request->file('cimg');
            $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('images/company_images/'), $file_name);
            $com->image = $file_name;
        }

        if ($com->save())
            return response()->json(["success" => "Company Successfully Added"]);
        else
            return response()->json(["errors" => "Company Can't Be Added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::all();
        $i = 1;

        return view('pages.users.users', compact('user', 'i'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $com = Company::find($id);
        return view('pages.company.edit_company', compact('com', 'id'));
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
        $com = Company::find($id);
        $com->name = $request->cname;
        $com->cat_id = $request->cat_id;
        if ($request->hasFile('cimg')) {
            $file = $request->file('cimg');
            $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('images/company_images/'), $file_name);
            $com->image = $file_name;
        }

        if ($com->save())
            return redirect('Companies/'.$id);
        else
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $c = Company::find($request->id);
        if ($c->delete())
            echo "Record Deleted";
        else
            echo "Error Occured";
    }

    public function showBanner()
    {
        $banner = Banner::where('active', 'Y')->get();
        $i = 1;

        return view('pages.company.banners', compact('banner', 'i'));
    }

    public function showModels($id)
    {
        $models = Pmodel::select('pmodels.*', 'companies.name as cname', 'categories.id as catid', 'categories.name as catname')->join('companies', 'pmodels.cid', '=', 'companies.id')
            ->join('categories', 'pmodels.cat_id', '=', 'categories.id')->where('pmodels.cid', $id)->get();
        $i = 1;

        return view('pages.products.models', compact('models', 'i', 'id'));
    }

    public function storeModel(Request $request)
    {
        $com = new Pmodel();
        $com->cid = $request->cid;
        $com->cat_id = $request->cat_id;
        $com->name = $request->mname;
        $com->warranty = $request->mwarrant;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('images/models/'), $file_name);
            $com->img = $file_name;
        }

        if ($com->save())
            return response()->json(["success" => "Model Successfully Added"]);
        else
            return response()->json(["errors" => "Model Can't Be Added"]);
    }

    public function updModel(Request $request)
    {
        $com = Pmodel::find($request->id);
        $com->cid = $request->cid;
        $com->cat_id = $request->cat_id;
        $com->name = $request->mname;
        $com->warranty = $request->mwarrant;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('images/models/'), $file_name);
            $com->img = $file_name;
        }

        if ($com->save())
            return response()->json(["success" => "Model Successfully Updated"]);
        else
            return response()->json(["errors" => "Model Can't Be Updated"]);
    }

    public function destroyModel(Request $request)
    {
        $c = Pmodel::find($request->id);
        if ($c->delete())
            echo "Record Deleted";
        else
            echo "Error Occured";
    }

    public function editModel($id)
    {
        $mod = Pmodel::find($id);
        
        return view('pages.products.edit_model', compact('mod', 'id'));
    }

    public function displayModel($id)
    {
        $com = Company::select('cat_id')->where('id', $id)->first();

        return view('pages.products.model', compact('com','id'));
    }

    public function fetchModel(Request $request)
    {
        $mod = Pmodel::where('cid', $request->id)->where('active', "Y")->get();
        $msg = '';
        foreach($mod as $m)
            $msg .= "<option value='".$m->id."'>".$m->name."</option>";

        echo $msg;
    }
    
    public function Orders()
    {
        $orders = Order::get();
        $i=1;
        
        return view('pages.company.orders', compact('orders','i'));
    }
    
    public function RejectOrder(Request $request)
    {
        $orders = Order::find($request->id);
        $orders->status = 'Rejected';

        if($orders->save())
            echo "Order Rejected";
        else
            echo "Error Occured";
    }

    public function AcceptOrder(Request $request)
    {
        $orders = Order::find($request->id);
        $orders->status = 'Accepted';

        if($orders->save())
            echo "Order Accepted";
        else
            echo "Error Occured";
    }
}
