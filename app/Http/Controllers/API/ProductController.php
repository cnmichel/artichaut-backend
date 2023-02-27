<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

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
            'price'     => 'required|decimal:0,2',
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
        $active = $request->has('active') ? $request->get('active') : $product->active;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $product->lang_id;

        $request->validate([
            'name'      => 'sometimes|required|max:50',
            'price'     => 'sometimes|required|decimal:2',
            'active'    => 'sometimes|required|boolean',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $product->name = $name;
        $product->price = $price;
        $product->active = $active;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvailable(Request $request)
    {

        $request->validate([
            'start_date'      => 'required|date|after_or_equal:now',
            'end_date'     => 'required|date|after:start_date'
        ]);

        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        $availableProducts = DB::table('reservations')
            ->select('reservations.*')
            ->leftJoin('product_reservation','product_reservation.reservation_id', '=', 'reservations.id')
            ->leftJoin('products', 'products.id', '=', 'product_reservation.product_id')
            ->where(function($query) use ($start_date,$end_date){
                $query->where('reservations.end_date', '<=' ,$start_date)
                    ->Where('reservations.start_date', '>=', $end_date)
                    ->orWhereNull('reservations.start_date')
                    ->orWhereNull('reservations.end_date');
            });

        $stantard = $availableProducts
            ->Where('products.id', '=', 1)
            ->get()
            ->count();

        $luxe = $availableProducts
            ->Where('products.id', '=', 2)
            ->get()
            ->count();

        $suite = $availableProducts
            ->Where('products.id', '=', 3)
            ->get()
            ->count();

        $chambres = ['ChambresStandard' => 25 - $stantard, 'ChambresLuxe' => 5 - $luxe, 'ChambreSuite' => 1 - $suite];


        return response()->json($chambres);
    }
}
