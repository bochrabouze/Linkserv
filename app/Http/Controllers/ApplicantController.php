<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function store(Request $request)
    {
       try{

       
        // new Application
        $applicant =new Applicant([
            
            
            'user_id' => 2,
            'Profession' => $request->input('Profession'),
            'Description' => $request->input('Description'),
           
            
            
        ]);
        $applicant->save();
    } catch (\Throwable $th) {
               
            
        return response()->json($th->getMessage());
    }
        return response()->json('applicant created!');
    }


public function index()
{
    //
    $result=[];
    $applicants = Applicant::all();
    $i=0;
    
    // dd($result);
    return response()->json($applicants, 200);
}
}