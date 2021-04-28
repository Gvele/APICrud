<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Product::all(); 
        // return ["Entered"=>"index function"]; 
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
         $validator= Validator::make($request->all(), [
            'name' => 'required',
            'price'=> 'required', 
            'currency'=>['required' ,  Rule::in(['GEL', 'USD', 'EUR'])]
        ] ); 
        if($validator->fails()){

            return $validator->errors();
        }
        else{

            $product= new Product; 
            $product->name= $request->name; 
            $product->description=$request->description; 
            $product->price=$request->price; 
            $product->currency=$request->currency; 
            $result=$product->save(); 
            if($result){
                return ["Result"=>"Data has been saved!"];
            }
            else{
                return[ "error"=>"Something went wrong"]; 
            }
            
        }

        
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
        return Product::find($id); 
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

        //


        $validator= Validator::make($request->all(), [
            'name' => 'required',
            'price'=> 'required', 
            'currency'=>['required' ,  Rule::in(['GEL', 'USD', 'EUR'])]
        ] ); 
        if($validator->fails()){

            return $validator->errors();
        }
        else{

        $product= Product::find($id); 
        $product->name= $request->name; 
        $product->description=$request->description; 
        $product->price=$request->price; 
        $product->currency=$request->currency; 
        $result=$product->save(); 
        if($result){
            return ["Result"=>"Data has been updated!"];
        }
        else{
            return[ "error"=>"Something went wrong"]; 
        }

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
        $product=Product::find($id); 
        $result=$product->delete(); 
        if($result){
            return ["Result"=>"Data has been deleted!"];
        }
        else{
            return[ "error"=>"Something went wrong"]; 
        }


    }


    public function allowedCurrency(){

        return ["Currency"=>"GEL, USD, EUR"]; 
    }



}
