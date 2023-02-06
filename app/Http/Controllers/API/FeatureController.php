<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $features = Feature::all();
        return response()->json($features);
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
            'content'   => 'required|max:255',
            'icon'      => 'required|max:50',
            'order'     => 'required|integer',
            'lang_id'   => 'required|exists:langs,id'
        ]);

        $newFeature = new Feature([
            'name'      => $request->get('name'),
            'content'   => $request->get('content'),
            'icon'      => $request->get('icon'),
            'order'     => $request->get('order'),
            'lang_id'   => $request->get('lang_id')
        ]);

        $newFeature->save();

        return response()->json($newFeature, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $feature = Feature::findOrFail($id);
        return response()->json($feature);
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
        $feature = Feature::findOrFail($id);

        $name = $request->has('name') ? $request->get('name') : $feature->name;
        $content = $request->has('content') ? $request->get('content') : $feature->content;
        $icon = $request->has('icon') ? $request->get('icon') : $feature->icon;
        $order = $request->has('order') ? $request->get('order') : $feature->order;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $feature->lang_id;

        $request->validate([
            'name'      => 'sometimes|required|max:50',
            'content'   => 'sometimes|required|max:255',
            'icon'      => 'sometimes|required|max:50',
            'order'     => 'sometimes|required|integer',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $feature->name = $name;
        $feature->content = $content;
        $feature->icon = $icon;
        $feature->order = $order;
        $feature->lang_id = $lang_id;

        $feature->save();

        return response()->json($feature);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();

        return response()->json($feature::all());
    }
}
