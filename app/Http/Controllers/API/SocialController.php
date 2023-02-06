<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $socials = Social::all();
        return response()->json($socials);
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
            'icon'      => 'required|max:50',
            'url'       => 'required',
            'order'     => 'required|integer',
            'lang_id'   => 'required|exists:langs,id'
        ]);

        $newSocial = new Social([
            'name'      => $request->get('name'),
            'icon'      => $request->get('icon'),
            'url'       => $request->get('url'),
            'order'     => $request->get('order'),
            'lang_id'   => $request->get('lang_id'),
        ]);

        $newSocial->save();

        return response()->json($newSocial, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $social = Social::findOrFail($id);
        return response()->json($social);
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
        $social = Social::findOrFail($id);

        $name = $request->has('name') ? $request->get('name') : $social->name;
        $icon = $request->has('icon') ? $request->get('icon') : $social->icon;
        $url = $request->has('url') ? $request->get('url') : $social->url;
        $order = $request->has('order') ? $request->get('order') : $social->order;
        $active = $request->has('active') ? $request->get('active') : $social->active;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $social->lang_id;

        $request->validate([
            'name'      => 'sometimes|required|max:50',
            'icon'      => 'sometimes|required|max:50',
            'url'       => 'sometimes|required',
            'order'     => 'sometimes|required|integer',
            'active'    => 'sometimes|required|boolean',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $social->name = $name;
        $social->icon = $icon;
        $social->url = $url;
        $social->order = $order;
        $social->active = $active;
        $social->lang_id = $lang_id;

        $social->save();

        return response()->json($social);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $social = Social::findOrFail($id);
        $social->delete();

        return response()->json($social::all());
    }
}
