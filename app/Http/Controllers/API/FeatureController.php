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
            'title' => 'required|max:50',
            'content' => 'required|max:255',
            'icon' =>  'required|max:50',
            'order' => 'required'
        ]);

        $newFeature = new Feature([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'icon' => $request->get('icon'),
            'order' => $request->get('order'),
            'lang_id' => $request->get('lang_id')
        ]);

        $newFeature->save();

        return response()->json($newFeature);
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

        $request->validate([
            'title' => 'required|max:50',
            'content' => 'required|max:255',
            'icon' =>  'required|max:50',
            'order' => 'required'
        ]);

        $feature->title = $request->get('title');
        $feature->content = $request->get('content');
        $feature->icon = $request->get('icon');
        $feature->order = $request->get('order');
        $feature->lang_id = $request->get('lang_id');

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
