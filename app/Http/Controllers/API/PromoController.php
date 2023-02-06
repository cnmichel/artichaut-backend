<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $promos = Promo::all();
        return response()->json($promos);
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
            'content'   => 'required|',
            'active'    => 'required|boolean',
            'lang_id'   => 'required|exists:langs,id'
        ]);

        $newPromo = new Promo([
            'name'      => $request->get('name'),
            'content'   => $request->get('content'),
            'active'    => $request->get('active'),
            'lang_id'   => $request->get('lang_id'),
        ]);

        $newPromo->save();

        return response()->json($newPromo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $promo = Promo::findOrFail($id);
        return response()->json($promo);
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
        $promo = Promo::findOrFail($id);

        $name = $request->has('name') ? $request->get('name') : $promo->name;
        $content = $request->has('content') ? $request->get('content') : $promo->content;
        $active = $request->has('active') ? $request->get('active') : $promo->active;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $promo->lang_id;

        $request->validate([
            'name'      => 'sometimes|required|max:50',
            'content'   => 'sometimes|required|',
            'active'    => 'sometimes|required|boolean',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $promo->name = $name;
        $promo->content = $content;
        $promo->active = $active;
        $promo->lang_id = $lang_id;

        $promo->save();

        return response()->json($promo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();

        return response()->json($promo::all());
    }
}
