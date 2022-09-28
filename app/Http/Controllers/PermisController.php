<?php

namespace App\Http\Controllers;

use App\Models\Permis;
use Illuminate\Http\Request;

class PermisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result=[];
        $permiss = Permis::all();
        $i=0;
        foreach ($permiss as $permis) {
            //
                    
           $result[$i]=$permis;
           $i++; 
        }
        // dd($result);
        return response()->json($result, 200);
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
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function show(Permis $permis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function edit(Permis $permis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permis $permis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permis  $permis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permis $permis)
    {
        //
    }
}
