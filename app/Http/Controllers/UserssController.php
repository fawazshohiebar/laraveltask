<?php

namespace App\Http\Controllers;

use App\Models\Userss;
use Illuminate\Http\Request;


class UserssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Userr = Userss::all();
        $UserrData = $Userr->map(function ($admins) {
            return [
                'id' => $admins->id,
                'name' => $admins->name,
                'email' => $admins->email, 
                'sex' => $admins->sex, 
                'blood_type' => $admins->blood_type, 
                'is_approved' => $admins->is_approved, 

            ];
        });
        return $Userr;
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
        



 $Userr = new Userss();
        $Userr->name=$request->input('name');
        $Userr->email=$request->input('email');
        $Userr->sex=$request->input('sex');
        $Userr->blood_type=$request->input('blood_type');
        $Userr->role=$request->input('role');
        $Userr->is_approved = false;




        $Userr->save();
        return response()->json(['message' => 'Userr$Userr created successfully'], 201);
     




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Userss  $userss
     * @return \Illuminate\Http\Response
     */
    public function show(Userss $userss, Request $request, $id)
    {
        $userss = Userss::find($id);
    
        if (!$userss) {
            return response()->json(['message' => 'Userss not found'], 404);
        }
    
        return response()->json(['data' => $userss], 200);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Userss  $userss
     * @return \Illuminate\Http\Response
     */
    public function edit(Userss $userss , Request  $request, $id )
    {
        $userss = Userss::find($id);
    
        if (!$userss) {
            return response()->json(['message' => 'Userss not found'], 404);
        }
    
        $userss->is_approved = true;
    
        $userss->save();
    
        return response()->json(['message' => 'Userss updated successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Userss  $userss
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Userss $userss, $id)
    {
        try {
            $Userss = Userss::findOrFail($id);
    
            $Userss->name = $request->has('name') ? $request->input('name') : $Userss->name;
            $Userss->email = $request->has('email') ? $request->input('email') : $Userss->email;
            $Userss->sex = $request->has('sex') ? $request->input('sex') : $Userss->sex;
            $Userss->blood_type = $request->has('blood_type') ? $request->input('blood_type') : $Userss->blood_type;
    
            $Userss->save();
    
            return response()->json(['message' => 'Userss updated successfully'], 200);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Failed to update Userss', 'error' => $exception->getMessage()], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Userss  $userss
     * @return \Illuminate\Http\Response
     */
    public function destroy(Userss $userss,$id)
    {
        $Userdeleted = Userss::find($id);
        $Userdeleted->delete();
        return "the user  have been deleted ";
    }





    public function checking(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
    
        try {
            $user = Userss::where('email', $email)
                        ->where('name', $name)
                        ->first();
    
            if ($user) {
                // User exists, include the role in the response
                return response()->json(['message' => 'Welcome User exists', 'role' => $user->role, 'userID'=>$user->id , 'is_approved'=> $user->is_approved ], 200);
            } else {
                return response()->json(['error' => 'User doesn\'t exist'], 409);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the query
            // You can log the error or perform other error handling actions
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    
    










}
