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
    public function index(Request $request)
    {
        // Get the params from request
        $lang = $request->get('lang_id');

        // Get a Builder instance
        $query = Hero::query();

        if ($lang) {
            // Conditionally add a WHERE
            $query->where('lang_id', $lang);
        }

        // Finish the query
        $heroes = $query->get();
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
            'cta'       => 'required',
            'lang_id'   => 'required|exists:langs,id'
        ]);

        $newHero = new Hero([
            'title'     => $request->get('title'),
            'subtitle'  => $request->get('subtitle'),
            'image'     => $request->get('image'),
            'cta'       => $request->get('cta'),
            'lang_id'   => $request->get('lang_id'),
        ]);

        $newHero->save();

        return response()->json($newHero, 201);
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

        $title = $request->has('title') ? $request->get('title') : $hero->title;
        $subtitle = $request->has('subtitle') ? $request->get('subtitle') : $hero->subtitle;
        $image = $request->has('image') ? $request->get('image') : $hero->image;
        $cta = $request->has('cta') ? $request->get('cta') : $hero->cta;
        $active = $request->has('active') ? $request->get('active') : $hero->active;
        $lang_id = $request->has('lang_id') ? $request->get('lang_id') : $hero->lang_id;

        $request->validate([
            'title'     => 'sometimes|required|max:50',
            'subtitle'  => 'sometimes|required|max:255',
            'image'     => 'sometimes|required',
            'cta'       => 'sometimes|required',
            'active'    => 'sometimes|required|boolean',
            'lang_id'   => 'sometimes|required|exists:langs,id'
        ]);

        $hero->title = $title;
        $hero->subtitle = $subtitle;
        $hero->image = $image;
        $hero->cta = $cta;
        $hero->active = $active;
        $hero->lang_id = $lang_id;

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
