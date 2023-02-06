<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:50',
            'price'     => 'required|decimal:2',
            'lang_id'   => 'required|exists:langs,id'
        ]);

        $newProduct = new Product([
            'name'      => $request->get('name'),
            'price'     => $request->get('price'),
            'lang_id'   => $request->get('lang_id'),
        ]);

        $newProduct->save();

        return response()->json($newProduct, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $name = $request->has('name') ? $request->get('name') : $product->name;
        $price = $request->has('price') ? $request->get('price') : $product->price;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $product->lang_id;

        $request->validate([
            'name'      => 'sometimes|required|max:50',
            'price'     => 'sometimes|required|decimal:2',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $product->name = $name;
        $product->price = $price;
        $product->lang_id = $lang_id;

        $product->save();

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json($product::all());
    }
}
