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
            'name' => 'required|max:50',
            'url' => 'required',
            'order' => 'required'
        ]);

        $newSitemap = new Sitemap([
            'name' => $request->get('name'),
            'url' => $request->get('url'),
            'order' => $request->get('order'),
            'lang_id' => $request->get('lang_id'),
        ]);

        $newSitemap->save();

        return response()->json($newSitemap);
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

        $request->validate([
            'name' => 'required|max:50',
            'url' => 'required',
            'order' => 'required'
        ]);

        $sitemap->name = $request->get('name');
        $sitemap->icon = $request->get('icon');
        $sitemap->url = $request->get('url');
        $sitemap->lang_id = $request->get('lang_id');

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
