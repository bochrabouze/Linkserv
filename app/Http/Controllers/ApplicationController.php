<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        // $applications = Application::all()->toArray();
        // return array_reverse($applications);
        return response()->json('Application Now!');  
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
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try { 
        // new Application
        $application =new Application([
            
            
            'applicant_id' => 1,
            'Description' => $request->input('Description'),
            'Categorie' => $request->input('Categorie'),
            'Date' => $request->input('Date'),
            'Wage' => $request->input('Wage'),
            'Workers' => $request->input('Workers'),
            'State' => "Finished",

          
        ]);
        $application->save();
 

        
           
             
                //code...
            } catch (\Throwable $th) {
               
            
                return response()->json($th->getMessage());
            }
            
        
        return response()->json('application created') ; 

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
    public function update(Request $request, $id)
    {
        $application = Application::find($id);
        $application->update($request->all());

        return response()->json('Application updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::find($id);
        $application->delete();

        return response()->json('Application deleted!');
    }
}
