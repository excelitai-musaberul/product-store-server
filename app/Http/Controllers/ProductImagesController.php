<?php

namespace App\Http\Controllers;

use App\Models\ProductImages;
use Illuminate\Http\Request;
use Validator;

class ProductImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Storage::disk('local')->get('0K2LkmckB4zzoSbvxEhHAx6hj67E3KFLyTGiHWbA.jpg');
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
     * @param  \App\Models\ProductImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function show(ProductImages $productImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductImages $productImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductImages $productImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImages  $productImages
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductImages $productImages)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductImages  $files
     * @return \Illuminate\Http\Response
     */

    public function upload(Request $request)
    {
 
       $validator = Validator::make($request->all(),[ 
              'file' => 'required',
              'productId' => 'required'
        ]);   
 
        if($validator->fails()) {          
            
            return response()->json(['error'=>$validator->errors()], 401);                        
         }  
 
  
        if ($file = $request->file('file')) {
            // $path = $file->move('/images/products');
            // $name = $file->getClientOriginalName();
            // $path = $file->move(public_path('/images/products'), $name);         
 
            //store your file into directory and db
            
            // $save->fileName = $name;
            // $save->path= $path;
            


            // $image = $request->file('file');


            $save = new ProductImages();
            $extension = $file->extension();
            // $name = time().'.'.$extension;
            $name = time().$file->getClientOriginalName();
            $file->move(public_path('/upload/images/products/'), $name);
            $path = 'upload/images/products/'.$name;

            $save->fileName = $file->getClientOriginalName();
            $save->path= $path;
            $save->productId= $request->productId;
            $save->save();           
              
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $name
            ]);
  
        }
  
    }
}
