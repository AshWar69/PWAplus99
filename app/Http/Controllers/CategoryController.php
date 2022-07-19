<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Company;
use App\Models\Pmodel;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // $category = Category::where('status', 'Y')->where('parent_id', null)->get();

        // return view('pages.products.categories', compact('category'));
        if ($request->ajax()) {
            $cat = Category::where('parent_id', null)->get();

            return datatables()->of($cat)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return "<a class='fs-15' href='cats/$data->id/edit' title='Edit'><i class='ri-edit-2-line'></i></a>
                        <a href='javascript:void(0);' title='Delete' class='del link-danger ml-2 fs-15' id='$data->id'><i class='ri-delete-bin-line'></i></a>
                        <a href='Companies/$data->id'  title='Add Company' class='link-success ml-2 fs-15'><i class='ri-building-fill'></i></a>";
                })
                ->toJson();
        }
    }

    public function showProduct($id)
    {
        $p = Pmodel::where('cid',$id)->count();

        if ($p > 0) {
            $type = 'Model';
            $com = Pmodel::select('companies.id as cid', 'categories.id as cat_id')->join('categories', 'pmodels.cat_id', '=', 'categories.id')
                ->join('companies', 'pmodels.cid', '=', 'companies.id')->where('pmodels.id', $id)->first();
 
            return view('pages.products.product', compact('com', 'id', 'type'));
        } else {
            $type = 'Company';
            $com = Company::select('cat_id')->where('id', $id)->first();

            return view('pages.products.product', compact('com', 'id', 'type'));
        }
    }

    // public function childTreeView($id, $currLevel = 0, $prevLevel = -1)
    // {
    //     $data = Category::select('id', 'name', 'parent_id')
    //         ->where('parent_id', '=', $id)->where('status', '=', 1)->orderBy('id')->get();
    //     $code = '';
    //     foreach ($data as $category) {
    //         if ($id == $category->parent_id) {

    //             if ($currLevel > $prevLevel) $code .= "<ul class='nested'>";
    //             if ($currLevel == $prevLevel) $code .= "</span></li>";
    //             $code .= '<li class="list-group-item"><span class="caret" id="' . $category->id . '">'
    //                 . $category->name . "</span>
    //                 <a href='#' value=" . $category->id . " class='plus'><i class='fa fa-plus float-right ml-2'></i></a>
    //                 <a href='#' value=" . $category->id . " class='minus'><i class='fa fa-minus float-right'></i></a>";
    //             if ($currLevel > $prevLevel) {
    //                 $prevLevel = $currLevel;
    //             }
    //             $currLevel++;
    //         }
    //         CategoryController::childTreeView($category->id,  $currLevel, $prevLevel);
    //         $currLevel--;
    //     }
    //     if ($currLevel == $prevLevel) $code .= " </li> </ul> ";

    //     echo $code;
    // }

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
        $cat = new Category();
        $cat->name = $request->catname;
        $cat->parent_id = $request->pcat;
        if ($request->hasFile('catimg')) {
            $file = $request->file('catimg');
            $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('images/category_images/'), $file_name);
            $cat->img = $file_name;
        }

        if ($cat->save())
            return response()->json(["success" => "Category Added"]);
        else
            return response()->json(["errors" => "Error Occured"]);
    }

    public function storeMainCat(Request $request)
    {
        $cat = new Category();
        $cat->name = $request->main_cat;
        if ($request->hasFile('catimg')) {
            $file = $request->file('catimg');
            $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('images/category_images/'), $file_name);
            $cat->img = $file_name;
        }

        if ($cat->save())
            return response()->json(["success" => "Main Category Added"]);
        else
            return response()->json(["errors" => "Error Occured"]);
    }

    public function storeProduct(Request $request)
    {
        $pro = new Product();
        if ($request->type == 'Model') {
            $pro->name = $request->pname;
            $pro->category = $request->cat_id;
            $pro->model = $request->mid;
            $pro->quantity = $request->quantity;
            $pro->perprice = $request->per;
            $pro->price = $request->rate;
            $pro->cgst = $request->cgst;
            $pro->sgst = $request->sgst;
            $pro->company = $request->cid;
            if ($request->hasFile('pimg')) {
                $file = $request->file('pimg');
                $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(base_path('images/product_images/'), $file_name);
                $pro->image = $file_name;
            }
        }
        elseif($request->type == 'Company'){
            $pro->name = $request->pname;
            $pro->category = $request->cat_id;
            $pro->quantity = $request->quantity;
            $pro->perprice = $request->per;
            $pro->price = $request->rate;
            $pro->cgst = $request->cgst;
            $pro->sgst = $request->sgst;
            $pro->company = $request->cid;
            if ($request->hasFile('pimg')) {
                $file = $request->file('pimg');
                $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(base_path('images/product_images/'), $file_name);
                $pro->image = $file_name;
            }
        }

        if ($pro->save())
            return response()->json(["success" => "Product Successfully Added"]);
        else
            return response()->json(["errors" => "Product Can't Be Added"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $i = 1;
        $com = Pmodel::where('cid', $id)->orderBy('id', 'desc')->count();
        if ($com > 0) {
            $type = 'Models';
            $pro = Product::select('products.*', 'pmodels.name as modelname', 'companies.name as cname')->join('pmodels', 'products.model', '=', 'pmodels.id')
                ->join('companies', 'products.company', '=', 'companies.id')->where('model', $id)->get();

            return view('pages.products.products', compact('pro', 'i', 'id', 'type'));
        } else {
            $type = 'Company';
            $pro = Product::select('products.*', 'companies.name as cname')->join('companies', 'products.company', '=', 'companies.id')
                ->where('companies.id', $id)->get();

            return view('pages.products.products', compact('pro', 'i', 'id', 'type'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('pages.products.edit_categories', compact('cat','id'));
    }

    public function editProduct($id)
    {
        $pro = Product::find($id);

        return view("pages.products.edit_product", compact("pro"));
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
        $pro = Product::find($request->id);
            $pro->name = $request->pname;
            $pro->category = $request->cat_id;
            $pro->model = $request->mid;
            $pro->quantity = $request->quantity;
            $pro->perprice = $request->per;
            $pro->price = $request->rate;
            $pro->cgst = $request->cgst;
            $pro->sgst = $request->sgst;
            $pro->company = $request->cid;
            if ($request->hasFile('pimg')) {
                $file = $request->file('pimg');
                $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
                $file->move(base_path('images/product_images/'), $file_name);
                $pro->image = $file_name;
            }

        if ($pro->save())
            return response()->json(["success" => "Product Successfully Updated"]);
        else
            return response()->json(["errors" => "Product Can't Be Updated"]);
    }
    
    public function updateCategory(Request $request)
    {
        $cat = Category::find($request->id);
        $cat->name = $request->main_cat;
        if ($request->hasFile('catimg')){
            $file = $request->file('catimg');
            $file_name = time() . rand(1, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('images/category_images/'), $file_name);
            $cat->img = $file_name;
        }

        if ($cat->save())
            return response()->json(["success" => "Category Updated"]);
        else
            return response()->json(["errors" => "Error Occured"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::find($id);
        $cats = Category::where('parent_id', $id)->get();
        if ($cats) {
            foreach ($cats as $ca) {
                $d = Category::find($ca->id);
                $d->delete();
            }
            if ($cat->delete())
                echo "Record Deleted";
            else
                echo "Error Occured";
        } else {
            if ($cat->delete())
                echo "Record Deleted";
            else
                echo "Error Occured";
        }
    }

    public function destroyProduct(Request $request)
    {
        $p = Product::find($request->id);
        if ($p->delete())
            echo "Record Deleted";
        else
            echo "Error Occured";
    }


    public function storeBanner(Request $request)
    {
        $ban = new Banner();

        $ban->type = $request->type;
        if ($request->hasFile("bimg")) {
            $file = $request->file("bimg");
            $file_name = time() . rand(1, 999) . "." . $file->getClientOriginalExtension();
            $file->move(base_path("images/banners/"), $file_name);
            $ban->imgname = $file_name;
        }
        if ($ban->save())
            return response()->json(["success" => "Banner Successfully Added"]);
        else
            return response()->json(["errors" => "Banner Can't Be Added"]);
    }

    public function editBanner($id)
    {
        $ban = Banner::find($id);
        return view("pages.company.edit_banner", compact("ban"));
    }

    public function updateBanner(Request $request)
    {
        $ban = Banner::find($request->id);

        $ban->type = $request->type;
        if ($request->hasFile("bimg")) {
            if (file_exists(base_path('images/banners' . $ban->imgname)))
                unlink(base_path('/images/banners' . $ban->imgname));

            $file = $request->file("bimg");
            $file_name = time() . rand(1, 999) . "." . $file->getClientOriginalExtension();
            $file->move(base_path("images/banners/"), $file_name);
            $ban->imgname = $file_name;
        }
        if ($ban->save())
            return response()->json(["success" => "Banner Successfully Updated"]);
        else
            return response()->json(["errors" => "Banner Cant Be Updated"]);
    }

    public function destroyBan($id)
    {
        $ban = Banner::find($id);
        if (file_exists(base_path('images/banners/' . $ban->imgname))) {
            unlink(base_path('images/banners/' . $ban->imgname));

            if ($ban->delete())
                echo "Record Deleted";
            else
                echo "Error Occured";
        }
    }
}
