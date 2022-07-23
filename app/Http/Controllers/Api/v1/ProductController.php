<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use File;
use Storage;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    * $models = Product::with(!empty($request->get('include')) ? explode(',', $request->get('include')) : [])->get();
    * $models->append(!empty($request->append) ? explode(',', $request->get('append')) : []);
    * Item::withTrashed()->get();Item::onlyTrashed()->get();
    */

    public function index()
    {
        $models = Product::where('status',1)->paginate(25);
        return ProductResource::collection($models);
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
    public function store(ProductRequest $request)
    {
        
        $request->validated();
        // $model = Product::create($request->validate());
        $file = $request->file('img');
        $filenamehash = md5(time()). '.' . $file->getClientOriginalExtension();

        $model = Product::create([
            'name' => $request->name,
            'img' => $filenamehash,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);
            
        Storage::makeDirectory(public_path('uploads/product/' . $model->id));
        $file->move(public_path('uploads/product/' . $model->id), $filenamehash);

        return new ProductResource($model);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Product::findOrFail($id);
        return new ProductResource($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRequest $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $model = Product::findOrFail($id);
         
        $request->validated();   
        // $model->update($request->validate());
        
        $old_img = $model->img;
        File::delete(public_path('uploads/product/'.$model->id.'/'.$old_img));

        $file = $request->file('img');
       
        $filenamehash = md5(time()). '.' . $file->getClientOriginalExtension();
        
        $model->name = $request->name;
        $model->img = $filenamehash;
        $model->status = $request->status;
        $model->category_id = $request->category_id;
        
            
        Storage::makeDirectory(public_path('uploads/product/' . $model->id));
        $file->move(public_path('uploads/product/' . $model->id), $filenamehash);
        
        $model->update();

        return new ProductResource($model);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json('successfully deleted',204);
        
    }
}
