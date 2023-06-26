<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificate = Certificates::all();
        $certificateData = $certificate->map(function ($certificate) {
            return [
                'id' => $certificate->id,
                'name' => $certificate->name,
          
            ];
        });
        return $certificate;
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
        $certificate = new Certificates();
        $certificate->name=$request->input('name');
        $certificate->save();
        return response()->json(['message' => 'certificate  created successfully'], 201);
     


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function show(Certificates $certificates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificates $certificates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificates $certificates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Certificates  $certificates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificates $certificates,$id)
    {
        $certificatedelete = Certificates::find($id);
        $certificatedelete->delete();
        return "the certificate   have been deleted ";
    }
}
