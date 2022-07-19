<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_info = User::find(Auth::id());
        return response()->json([['status'=>200, 'msg'=>'Data Found', 'Data'=>$user_info]]);
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
        $add = Address::where('uid',Auth::id())->get();
        return response()->json(['status'=>200, 'msg'=>'Data Found', 'Data'=>$add]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user = User::find(Auth::id());
        if($request->name > '')
            $user->name = $request->name;
        if($request->gender > '')
            $user->gender = $request->gender;
        if($request->email > '')
            $user->email = $request->email;
        if($request->alternatenumber > '')
            $user->alternateNumber = $request->alternatenumber;

        if($request->hasFile('profile')){
            $file = $request->file('profile');
            $file_name = time().rand(1,999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/users/'),$file_name);
            $user->img = $file_name;
        }

        if($user->save()){
            return response()->json(['status'=>200, 'msg'=>'Profile Updated Successfully']);
        }
        else
            return response()->json(['status'=>200, 'msg'=>'Error Occured']);
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
        if($request->type == 'add')
        {
            $add = new Address();

            $add->uid = Auth::id();
            if($request->address > '')
                $add->address = $request->address;

            if($add->save())
                return response()->json(['status'=>200,'msg'=>'Address Saved Successfully']);
            else
                return response()->json(['status'=>200, 'msg'=>'Error Occured']);
        }
        elseif($request->type == 'upd')
        {
            $add = Address::find(Auth::id());
            if($request->address > '')
                $add->address = $request->address;
    
            if($add->save())
                return response()->json(['status'=>200, 'msg'=>'Address Updated Successfully']);
            else
                return response()->json(['status'=>200, 'msg'=>'Error Occured']);
        }
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
