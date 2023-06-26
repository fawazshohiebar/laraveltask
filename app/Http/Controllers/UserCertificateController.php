<?php

namespace App\Http\Controllers;

use App\Models\User_Certificate;
use Illuminate\Http\Request;

class UserCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCertificate = User_Certificate::all();
        $certificateData = $userCertificate->map(function ($userCertificate) {
            return [
                'id' => $userCertificate->id,
                'user_id' => $userCertificate->user_id,
                'certificate_id' => $userCertificate->certificate_id,
          
            ];
        });
        return $userCertificate;
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
        $userCertificate = new User_Certificate();
        $userCertificate->user_id = $request->input('user_id');
        $userCertificate->certificate_id = $request->input('certificate_id');
        $userCertificate->save();
    
        return response()->json(['message' => 'User certificate created successfully'], 201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_Certificate  $user_Certificate
     * @return \Illuminate\Http\Response
     */
    public function show(User_Certificate $user_Certificate ,$userId)
    {
        $userCertificates = User_Certificate::where('user_id', $userId)->get();
    
        $certificateData = $userCertificates->map(function ($userCertificate) {
            return [
                'id' => $userCertificate->id,
                'user_id' => $userCertificate->user_id,
                'certificate_id' => $userCertificate->certificate_id,
            ];
        });
    
        return $certificateData;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_Certificate  $user_Certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(User_Certificate $user_Certificate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User_Certificate  $user_Certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User_Certificate $user_Certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_Certificate  $user_Certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_Certificate $user_Certificate,$id)
    {
      
            //
            $User_Certificate = User_Certificate::find($id);
            $User_Certificate->delete();
            return "the id have been deleted ";
     
    }
}
