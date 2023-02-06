<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sitemap;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sitemaps = Sitemap::all();
        return response()->json($sitemaps);
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
            'url'       => 'required',
            'order'     => 'required|integer',
            'lang_id'   => 'required|exists:langs,id'
        ]);

        $newSitemap = new Sitemap([
            'name'      => $request->get('name'),
            'url'       => $request->get('url'),
            'order'     => $request->get('order'),
            'lang_id'   => $request->get('lang_id'),
        ]);

        $newSitemap->save();

        return response()->json($newSitemap, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $sitemap = Sitemap::findOrFail($id);
        return response()->json($sitemap);
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
        $sitemap = Sitemap::findOrFail($id);

        $name = $request->has('name') ? $request->get('name') : $sitemap->name;
        $url = $request->has('url') ? $request->get('url') : $sitemap->url;
        $order = $request->has('order') ? $request->get('order') : $sitemap->order;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $sitemap->lang_id;

        $request->validate([
            'name'      => 'sometimes|required|max:50',
            'url'       => 'sometimes|required',
            'order'     => 'sometimes|required|integer',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $sitemap->name = $name;
        $sitemap->icon = $url;
        $sitemap->url = $order;
        $sitemap->lang_id = $lang_id;

        $sitemap->save();

        return response()->json($sitemap);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $sitemap = Sitemap::findOrFail($id);
        $sitemap->delete();

        return response()->json($sitemap::all());
    }
}
