<?php

namespace App\Http\Controllers\API;

use App\Models\Hero;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $heroes = Hero::all();

        return response()->json($heroes);
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
            'title'     => 'required|max:50',
            'subtitle'  => 'required|max:255',
            'image'     => 'required',
            'cta'       => 'required'
        ]);

        $newHero = new Hero([
            'title'     => $request->get('title'),
            'subtitle'  => $request->get('subtitle'),
            'image'     => $request->get('image'),
            'cta'       => $request->get('cta'),
            'lang_id'   => $request->get('lang_id'),
        ]);

        $newHero->save();

        return response()->json($newHero);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $hero = Hero::findOrFail($id);

        return response()->json($hero);
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
        $hero = Hero::findOrFail($id);

        $request->validate([
            'title'     => 'required|max:50',
            'subtitle'  => 'required|max:255',
            'image'     => 'required',
            'cta'       => 'required'
        ]);

        $hero->title = $request->get('title');
        $hero->subtitle = $request->get('subtitle');
        $hero->image = $request->get('image');
        $hero->cta = $request->get('cta');
        $hero->lang_id = $request->get('lang_id');

        $hero->save();

        return response()->json($hero);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return response()->json($hero::all());
    }
}
