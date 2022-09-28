<?php

namespace App\Http\Controllers;

use App\Models\Servant;
use Illuminate\Http\Request;

class ServantController extends Controller
{
    public function store(Request $request)
    {
       try{

       
        // new Application
        $servant =new Servant([
            
            
            'user_id' => 2,
            'Profession' => $request->input('Profession'),
            'Description' => $request->input('Description'),
           
            
        ]);
        $servant->save();
    } catch (\Throwable $th) {
               
            
        return response()->json($th->getMessage());
    }
        return response()->json('servant created!');
    }

}
